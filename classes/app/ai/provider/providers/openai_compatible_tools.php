<?php

namespace local_mxaimanager\app\ai\provider\providers;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\tool;
use local_mxaimanager\app\ai\provider\tool_call;
use local_mxaimanager\app\ai\provider\tool_completion_request;
use local_mxaimanager\app\ai\provider\tool_result_message;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;

/**
 * Function calling for providers that speak the OpenAI chat completions dialect
 * (OpenAI, Azure-style gateways such as Scaleway, Mistral).
 *
 * Expects the using class to have $curl, $base_url and $chat_model, and to extend provider.
 */
trait openai_compatible_tools
{
    /**
     * Whether tool result messages carry the function name (Mistral wants it, OpenAI does not).
     */
    protected function tool_result_includes_name(): bool
    {
        return false;
    }

    /**
     * The provider's spelling of a tool_choice value.
     */
    protected function map_tool_choice(string $tool_choice): string
    {
        return $tool_choice;
    }

    /**
     * Label used in error messages.
     */
    protected function tool_provider_label(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @param message[] $messages
     * @param tool[] $tools
     * @param string $tool_choice 'auto', 'none' or 'required'.
     * @return tool_completion_request
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     */
    public function chat_completion_with_tools(
        array $messages,
        array $tools,
        string $tool_choice = 'auto'
    ): tool_completion_request {
        if (empty($this->chat_model)) {
            throw new invalid_provider_instance_configuration('Chat model is not configured');
        }

        $payload = [
            'model' => $this->chat_model,
            'messages' => $this->serialize_tool_conversation($this->merge_system_messages($messages)),
        ];
        if (!empty($tools)) {
            $payload['tools'] = array_values($tools);
            $payload['tool_choice'] = $this->map_tool_choice($tool_choice);
        }

        $label = $this->tool_provider_label();
        try {
            $response = $this->curl->post(
                "{$this->base_url}/v1/chat/completions",
                json_encode($payload, JSON_THROW_ON_ERROR)
            );
            $json = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

            $choice_message = $json['choices'][0]['message'] ?? null;
            if (!is_array($choice_message)) {
                throw new \Exception("Missing message in {$label} response. Response: " . $response);
            }

            return new tool_completion_request(
                $payload,
                $json,
                $this->content_to_text($choice_message['content'] ?? ''),
                (int) ($json['usage']['prompt_tokens'] ?? 0),
                (int) ($json['usage']['completion_tokens'] ?? 0),
                $json['choices'][0]['finish_reason'] ?? 'stop',
                $this->parse_tool_calls($choice_message['tool_calls'] ?? [])
            );
        } catch (\Throwable $t) {
            throw new invalid_provider_instance_response(
                "Invalid response from {$label}: " . $t->getMessage(),
                previous: $t
            );
        }
    }

    /**
     * @param message[] $messages
     * @return array[]
     */
    protected function serialize_tool_conversation(array $messages): array
    {
        $include_name = $this->tool_result_includes_name();
        return array_map(function ($message) use ($include_name) {
            $data = $message instanceof \JsonSerializable ? $message->jsonSerialize() : (array) $message;
            if ($message instanceof tool_result_message && !$include_name) {
                unset($data['name']);
            }
            return $data;
        }, $messages);
    }

    /**
     * Content can be a string, null (tool calls only) or, for reasoning models, a list of chunks.
     */
    protected function content_to_text(mixed $content): string
    {
        if (is_string($content)) {
            return $content;
        }
        if (!is_array($content)) {
            return '';
        }
        $text = '';
        foreach ($content as $chunk) {
            if (is_array($chunk) && ($chunk['type'] ?? '') === 'text') {
                $text .= $chunk['text'] ?? '';
            }
        }
        return $text;
    }

    /**
     * @return tool_call[]
     */
    protected function parse_tool_calls(array $raw_calls): array
    {
        $calls = [];
        foreach ($raw_calls as $index => $raw) {
            $name = $raw['function']['name'] ?? '';
            if ($name === '') {
                continue;
            }
            $arguments = $raw['function']['arguments'] ?? '{}';
            if (is_array($arguments)) {
                $decoded = $arguments;
                $arguments = json_encode($arguments, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                $decoded = json_decode((string) $arguments, true);
            }
            $calls[] = new tool_call(
                (string) ($raw['id'] ?? ('call_' . $index)),
                $name,
                is_array($decoded) ? $decoded : [],
                (string) $arguments
            );
        }
        return $calls;
    }
}
