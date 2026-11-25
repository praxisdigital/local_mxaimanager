<?php

namespace local_mxaimanager\unit\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\ai\provider\tool_transport;
use local_mxaimanager\app\ai\provider\providers\openai;
use local_mxaimanager\app\ai\provider\providers\mistral;
use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\ai\provider\providers\ollama;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use local_mxaimanager\app\exceptions\unsupported_tool_completion;
use local_mxaimanager\app\factory;

class tool_transport_test extends \base_testcase
{
    public static function providers(): array
    {
        return [
            'openai' => [openai::class, false],
            'mistral' => [mistral::class, false],
            'nebius' => [nebius::class, false],
            'ollama' => [ollama::class, true],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providers')]
    public function test_round_trip_tool_calls(string $class, bool $isollama): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(factory::class);
        $factory->method('curl')->willReturn($curl);
        $config = ['base_url' => 'https://example.test', 'api_key' => 'secret', 'chat_model' => 'test-model'];
        $provider = new $class($factory, $config);
        $adapter = tool_transport::for_provider($provider, $factory, $config);
        $messages = [
            ['role' => 'system', 'content' => 'first'],
            ['role' => 'system', 'content' => 'second'],
            ['role' => 'assistant', 'content' => '', 'tool_calls' => [
                ['id' => 'original', 'name' => 'lookup', 'arguments' => (object) ['id' => 3]],
            ]],
            ['role' => 'tool', 'content' => 'done', 'tool_call_id' => 'original', 'name' => 'lookup'],
        ];
        $tools = [[
            'name' => 'lookup', 'parameters' => ['type' => 'object', 'properties' => new \stdClass()],
        ]];
        $responsecall = $isollama ? ['function' => ['name' => 'lookup', 'arguments' => ['id' => 4]]] :
            ['id' => 'next', 'type' => 'function', 'function' => ['name' => 'lookup', 'arguments' => '{"id":4}']];
        $response = $isollama ? ['message' => ['role' => 'assistant', 'content' => '', 'tool_calls' => [$responsecall]],
            'prompt_eval_count' => 12, 'eval_count' => 3, 'done_reason' => 'stop'] :
            ['choices' => [['message' => ['content' => null, 'tool_calls' => [$responsecall]], 'finish_reason' => 'tool_calls']],
                'usage' => ['prompt_tokens' => 12, 'completion_tokens' => 3]];
        $curl->expects($this->once())->method('post')->with(
            'https://example.test' . ($isollama ? '/api/chat' : '/v1/chat/completions'),
            $this->callback(function ($body) use ($tools, $isollama, $class) {
                $payload = json_decode($body, true);
                $this->assertSame($tools[0]['name'], $payload['tools'][0]['function']['name']);
                $this->assertSame("first\nsecond", $payload['messages'][0]['content']);
                $call = $payload['messages'][1]['tool_calls'][0];
                $this->assertSame('lookup', $call['function']['name']);
                if ($isollama) {
                    $this->assertSame(['id' => 3], $call['function']['arguments']);
                    $this->assertSame('lookup', $payload['messages'][2]['tool_name']);
                } else {
                    $this->assertSame('original', $call['id']);
                    $this->assertSame('{"id":3}', $call['function']['arguments']);
                    $this->assertSame('original', $payload['messages'][2]['tool_call_id']);
                }
                if ($class === nebius::class) {
                    $this->assertSame(32000, $payload['max_tokens']);
                }
                return true;
            })
        )->willReturn(json_encode($response));
        $result = $adapter->complete($messages, $tools);
        $this->assertSame('', $result->get_response());
        $this->assertSame('lookup', $result->get_calls()[0]['name']);
        $this->assertNotEmpty($result->get_calls()[0]['id']);
        $this->assertEquals((object) ['id' => 4], (object) $result->get_calls()[0]['arguments']);
        $this->assertSame(12, $result->get_input_tokens());
        $this->assertSame(3, $result->get_output_tokens());
    }

    public function test_explicit_unsupported_throws_and_is_not_cached(): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(factory::class);
        $factory->method('curl')->willReturn($curl);
        $config = ['base_url' => 'https://example.test', 'api_key' => 'secret', 'chat_model' => 'model'];
        $adapter = tool_transport::for_provider(new ollama($factory, $config), $factory, $config);
        $curl->expects($this->exactly(2))->method('post')->willReturnOnConsecutiveCalls(
            '{"error":"model does not support tools"}',
            '{"message":{"content":"done"},"done_reason":"stop"}'
        );
        $curl->method('get_info')->willReturnOnConsecutiveCalls(['http_code' => 400], ['http_code' => 200]);
        $tools = [['name' => 'test', 'description' => '', 'parameters' => ['type' => 'object']]];
        try {
            $adapter->complete([], $tools);
            $this->fail('An explicit tool rejection must throw');
        } catch (unsupported_tool_completion $e) {
            $this->assertInstanceOf(invalid_provider_instance_response::class, $e);
            $this->assertStringContainsString('explicitly rejected tool support', $e->getMessage());
        }
        $this->assertSame('done', $adapter->complete([], $tools)->get_response());
    }

    public function test_auth_error_is_not_treated_as_unsupported(): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(factory::class);
        $factory->method('curl')->willReturn($curl);
        $config = ['base_url' => 'https://example.test', 'api_key' => 'secret', 'chat_model' => 'model'];
        $adapter = tool_transport::for_provider(new openai($factory, $config), $factory, $config);
        $curl->expects($this->exactly(2))->method('post')->willReturn('{"error":{"message":"invalid API key"}}');
        try {
            $adapter->complete([], [['name' => 'test']]);
            $this->fail('Authentication failure must throw');
        } catch (invalid_provider_instance_response $e) {
            $this->assertNotInstanceOf(unsupported_tool_completion::class, $e);
            $this->assertStringContainsString('Provider returned an error', $e->getMessage());
        }
        $this->expectException(invalid_provider_instance_response::class);
        $adapter->complete([], [['name' => 'test']]);
    }

    public function test_invalid_tool_arguments_fail(): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(factory::class);
        $factory->method('curl')->willReturn($curl);
        $config = ['base_url' => 'https://example.test', 'api_key' => 'secret', 'chat_model' => 'model'];
        $adapter = tool_transport::for_provider(new openai($factory, $config), $factory, $config);
        $curl->method('post')->willReturn('{"choices":[{"message":{"tool_calls":[{"id":"a","function":{"name":"x","arguments":"[1]"}}]}}]}');
        $this->expectException(invalid_provider_instance_response::class);
        $adapter->complete([], []);
    }
}
