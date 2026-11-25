<?php

namespace local_mxaimanager\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\ai\provider\providers\mistral;
use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\ai\provider\providers\ollama;
use local_mxaimanager\app\ai\provider\providers\openai;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use local_mxaimanager\app\exceptions\unsupported_tool_completion;
use local_mxaimanager\app\factory;

/** Native tool-call transport for the built-in chat providers. */
class tool_transport
{
    private factory $factory;
    private array $config;
    private bool $ollama;
    private bool $nebius;
    private bool $single_call_option;
    private bool $openai;

    private function __construct(factory $factory, array $config, bool $ollama, bool $nebius, bool $single_call_option, bool $openai)
    {
        $this->factory = $factory;
        $this->config = $config;
        $this->ollama = $ollama;
        $this->nebius = $nebius;
        $this->single_call_option = $single_call_option;
        $this->openai = $openai;
    }

    public static function for_provider(object $provider, factory $factory, array $config): ?self
    {
        if (!($provider instanceof openai || $provider instanceof mistral ||
                $provider instanceof nebius || $provider instanceof ollama)) {
            return null;
        }
        return new self($factory, $config, $provider instanceof ollama, $provider instanceof nebius,
            $provider instanceof openai || $provider instanceof mistral, $provider instanceof openai);
    }

    public function complete(array $messages, array $tools): tool_completion_request
    {
        $model = $this->config['chat_model'] ?? '';
        if ($model === '') {
            throw new invalid_provider_instance_configuration('Chat model is not configured');
        }
        $payload = ['model' => $model, 'messages' => $this->wire_messages($messages)];
        if ($this->ollama) {
            $payload['stream'] = false;
        }
        if ($this->nebius) {
            $payload['max_tokens'] = (int) (($this->config['max_tokens'] ?? '') ?: 32000);
        }
        if ($tools !== []) {
            $payload['tools'] = array_map(static function (array $tool): array {
                return ['type' => 'function', 'function' => $tool];
            }, $tools);
            if ($this->single_call_option) {
                $payload['parallel_tool_calls'] = false;
            }
        }

        $curl = $this->factory->curl();
        $curl->setHeader([
            'Authorization: Bearer ' . ($this->config['api_key'] ?? ''),
            'Content-Type: application/json',
        ]);
        $url = rtrim($this->config['base_url'], '/') . ($this->ollama ? '/api/chat' : '/v1/chat/completions');
        try {
            $response = $curl->post($url, json_encode($payload, JSON_THROW_ON_ERROR));
            $json = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            $info = $curl->get_info();
            $status = (int) ($info['http_code'] ?? 0);
            if (!is_array($json)) {
                throw new \UnexpectedValueException('Response is not an object');
            }
            if (isset($json['error'])) {
                $error = is_array($json['error']) ? ($json['error']['message'] ?? '') : $json['error'];
                if ($tools !== [] && in_array($status, [400, 422], true) && is_string($error) && self::explicit_unsupported($error)) {
                    throw new unsupported_tool_completion('Provider explicitly rejected tool support');
                }
                throw new \UnexpectedValueException('Provider returned an error');
            }
            if ($status >= 400) {
                throw new \UnexpectedValueException('Provider returned an HTTP error');
            }
            $message = $this->ollama ? ($json['message'] ?? null) : ($json['choices'][0]['message'] ?? null);
            if (!is_array($message)) {
                throw new \UnexpectedValueException('Missing assistant message');
            }
            if (!array_key_exists('content', $message) && empty($message['tool_calls'])) {
                throw new \UnexpectedValueException('Missing assistant content');
            }
            $content = $message['content'] ?? '';
            if ($content === null) {
                $content = '';
            } elseif (is_array($content)) {
                // Mistral reasoning models return text and thinking chunks.
                $content = implode('', array_map(static function ($chunk) {
                    return is_array($chunk) && ($chunk['type'] ?? '') === 'text' && is_string($chunk['text'] ?? null)
                        ? $chunk['text'] : '';
                }, $content));
            }
            if (!is_string($content)) {
                throw new \UnexpectedValueException('Invalid assistant content');
            }
            // Decode arguments as JSON objects, including empty objects nested inside Ollama calls.
            $wire = json_decode($response, false, 512, JSON_THROW_ON_ERROR);
            $calls = $this->read_calls(($this->ollama ? $wire->message : $wire->choices[0]->message)->tool_calls ?? []);
            $finish = $this->ollama ? ($json['done_reason'] ?? 'stop') : ($json['choices'][0]['finish_reason'] ?? 'stop');
            $input = $this->ollama ? ($json['prompt_eval_count'] ?? 0) : ($json['usage']['prompt_tokens'] ?? 0);
            $output = $this->ollama ? ($json['eval_count'] ?? 0) : ($json['usage']['completion_tokens'] ?? 0);
            return new tool_completion_request($payload, $json, $content, $calls, (int) $input, (int) $output, $finish);
        } catch (unsupported_tool_completion $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw new invalid_provider_instance_response('Invalid tool completion response: ' . $e->getMessage(), previous: $e);
        }
    }

    private static function explicit_unsupported(string $message): bool
    {
        return (bool) preg_match(
            '/\b(?:does not support|doesn.t support|do not support)\s+[`\x27\x22]?(?:tools\b|tool[ -]calling\b|function[ -]calling\b)|'
                . '(?<![\w.])(?:tools|tool[ -]calling|function[ -]calling)[`\x27\x22]?\s+(?:is\s+|are\s+)?(?:not supported|unsupported)\b/i',
            $message
        );
    }

    private function wire_messages(array $messages): array
    {
        $result = [];
        $systems = [];
        foreach ($messages as $message) {
            if (($message['role'] ?? '') === 'system') {
                $systems[] = $message['content'];
                continue;
            }
            if (($message['role'] ?? '') === 'assistant' && isset($message['tool_calls'])) {
                $calls = [];
                foreach ($message['tool_calls'] as $index => $call) {
                    $arguments = $call['arguments'];
                    if ($arguments === []) {
                        $arguments = new \stdClass();
                    }
                    $function = ['name' => $call['name'], 'arguments' => $this->ollama ? $arguments :
                        json_encode($arguments, JSON_THROW_ON_ERROR)];
                    $calls[] = $this->ollama ? ['type' => 'function', 'function' => ['index' => $index] + $function] :
                        ['id' => $call['id'], 'type' => 'function', 'function' => $function];
                }
                $message['tool_calls'] = $calls;
            } elseif (($message['role'] ?? '') === 'tool') {
                if ($this->ollama) {
                    $message['tool_name'] = $message['name'];
                    unset($message['name'], $message['tool_call_id']);
                } else if ($this->openai) {
                    unset($message['name']);
                }
            }
            $result[] = $message;
        }
        if ($systems) {
            array_unshift($result, ['role' => 'system', 'content' => implode("\n", $systems)]);
        }
        return $result;
    }

    private function read_calls(mixed $raw): array
    {
        if (!is_array($raw) || !array_is_list($raw)) {
            throw new \UnexpectedValueException('Invalid tool calls');
        }
        $calls = [];
        $ids = [];
        foreach ($raw as $call) {
            $function = $call->function ?? null;
            $id = $call->id ?? ($this->ollama ? bin2hex(random_bytes(12)) : null);
            if (!$function instanceof \stdClass || !is_string($id) || $id === '' || strlen($id) > 256 || isset($ids[$id]) ||
                    !is_string($function->name ?? null) || $function->name === '') {
                throw new \UnexpectedValueException('Invalid tool call identity');
            }
            $args = $function->arguments ?? null;
            if (is_string($args)) {
                $args = json_decode($args, false, 512, JSON_THROW_ON_ERROR);
            }
            if (!$args instanceof \stdClass) {
                throw new \UnexpectedValueException('Tool arguments must be an object');
            }
            $ids[$id] = true;
            $calls[] = ['id' => $id, 'name' => $function->name, 'arguments' => $args];
        }
        return $calls;
    }
}
