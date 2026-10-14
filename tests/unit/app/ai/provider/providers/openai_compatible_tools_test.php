<?php

namespace local_mxaimanager\unit\app\ai\provider\providers;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\providers\interfaces\tool_calling;
use local_mxaimanager\app\ai\provider\providers\mistral;
use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\ai\provider\providers\openai;
use local_mxaimanager\app\ai\provider\tool;
use local_mxaimanager\app\ai\provider\tool_call;
use local_mxaimanager\app\ai\provider\tool_calls_message;
use local_mxaimanager\app\ai\provider\tool_result_message;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @covers \local_mxaimanager\app\ai\provider\providers\openai_compatible_tools
 */
class openai_compatible_tools_test extends \base_testcase
{
    private MockObject $mock_base_factory;
    private MockObject $mock_curl;

    protected function setUp(): void
    {
        $this->mock_curl = $this->createMock(\curl::class);
        $this->mock_base_factory = $this->createMock(\local_mxaimanager\app\factory::class);
        $this->mock_base_factory->method('curl')->willReturn($this->mock_curl);
    }

    private function provider(string $classname): tool_calling
    {
        return new $classname($this->mock_base_factory, [
            'base_url' => 'https://example.test',
            'api_key' => 'key',
            'chat_model' => 'test-model',
        ]);
    }

    private function conversation(): array
    {
        $call = new tool_call('abc123def', 'replace_text', ['old' => 'a', 'new' => 'b'], '{"old":"a","new":"b"}');
        return [
            new message('system', 'sys'),
            new message('user', 'change a to b'),
            new tool_calls_message('', [$call]),
            new tool_result_message('abc123def', 'replace_text', 'OK'),
        ];
    }

    public function test_openai_mistral_and_nebius_support_tool_calling(): void
    {
        $this->assertInstanceOf(tool_calling::class, $this->provider(openai::class));
        $this->assertInstanceOf(tool_calling::class, $this->provider(mistral::class));
        $this->assertInstanceOf(tool_calling::class, $this->provider(nebius::class));
    }

    public function test_payload_and_parsed_tool_calls(): void
    {
        $sent = null;
        $this->mock_curl->expects($this->once())->method('post')
            ->willReturnCallback(function ($url, $body) use (&$sent) {
                $sent = json_decode($body, true);
                return json_encode([
                    'choices' => [[
                        'message' => [
                            'content' => null,
                            'tool_calls' => [
                                ['id' => 'x1', 'type' => 'function',
                                    'function' => ['name' => 'replace_text', 'arguments' => '{"old":"<h1>A</h1>","new":"<h1>B</h1>"}']],
                                ['id' => 'x2', 'type' => 'function',
                                    'function' => ['name' => 'replace_text', 'arguments' => ['old' => 'p', 'new' => 'q']]],
                            ],
                        ],
                        'finish_reason' => 'tool_calls',
                    ]],
                    'usage' => ['prompt_tokens' => 50, 'completion_tokens' => 20],
                ]);
            });

        $tools = [new tool('replace_text', 'Replace', ['type' => 'object'])];
        $request = $this->provider(openai::class)->chat_completion_with_tools($this->conversation(), $tools);

        $this->assertSame('test-model', $sent['model']);
        $this->assertSame('function', $sent['tools'][0]['type']);
        $this->assertSame('auto', $sent['tool_choice']);
        $this->assertSame('assistant', $sent['messages'][2]['role']);
        $this->assertNull($sent['messages'][2]['content']);
        $this->assertSame('abc123def', $sent['messages'][2]['tool_calls'][0]['id']);
        $this->assertSame('tool', $sent['messages'][3]['role']);
        $this->assertArrayNotHasKey('name', $sent['messages'][3], 'OpenAI tool results carry no name');

        $this->assertSame('', $request->get_response());
        $this->assertSame('tool_calls', $request->get_finish_reason());
        $this->assertCount(2, $request->get_tool_calls());
        $this->assertSame(['old' => '<h1>A</h1>', 'new' => '<h1>B</h1>'], $request->get_tool_calls()[0]->get_arguments());
        $this->assertSame(['old' => 'p', 'new' => 'q'], $request->get_tool_calls()[1]->get_arguments());
        $this->assertSame(50, $request->get_input_tokens());
    }

    public function test_mistral_tool_results_include_name_and_chunked_content_is_flattened(): void
    {
        $sent = null;
        $this->mock_curl->method('post')->willReturnCallback(function ($url, $body) use (&$sent) {
            $sent = json_decode($body, true);
            return json_encode([
                'choices' => [[
                    'message' => ['content' => [
                        ['type' => 'thinking', 'thinking' => [['type' => 'text', 'text' => 'hmm']]],
                        ['type' => 'text', 'text' => 'Done.'],
                    ]],
                    'finish_reason' => 'stop',
                ]],
                'usage' => ['prompt_tokens' => 1, 'completion_tokens' => 1],
            ]);
        });

        $tools = [new tool('replace_text', 'Replace', ['type' => 'object'])];
        $request = $this->provider(mistral::class)->chat_completion_with_tools($this->conversation(), $tools, 'required');

        $this->assertSame('any', $sent['tool_choice']);
        $this->assertSame('replace_text', $sent['messages'][3]['name']);
        $this->assertSame('Done.', $request->get_response());
        $this->assertSame([], $request->get_tool_calls());
    }

    public function test_plain_chat_completion_flattens_chunked_content(): void
    {
        $this->mock_curl->method('post')->willReturn(json_encode([
            'choices' => [[
                'message' => ['content' => [
                    ['type' => 'thinking', 'thinking' => [['type' => 'text', 'text' => 'hmm']]],
                    ['type' => 'text', 'text' => 'Hello'],
                    ['type' => 'text', 'text' => ' world'],
                ]],
                'finish_reason' => 'stop',
            ]],
            'usage' => ['prompt_tokens' => 1, 'completion_tokens' => 2],
        ]));

        foreach ([mistral::class, openai::class, nebius::class] as $classname) {
            $request = $this->provider($classname)->chat_completion([new message('user', 'hi')]);
            $this->assertSame('Hello world', $request->get_response(), $classname);
        }
    }

    public function test_reasoning_effort_is_sent_only_when_configured(): void
    {
        $sent = [];
        $this->mock_curl->method('post')->willReturnCallback(function ($url, $body) use (&$sent) {
            $sent[] = json_decode($body, true);
            return json_encode([
                'choices' => [['message' => ['content' => 'ok'], 'finish_reason' => 'stop']],
                'usage' => ['prompt_tokens' => 1, 'completion_tokens' => 1],
            ]);
        });
        $config = ['base_url' => 'https://example.test', 'api_key' => 'key', 'chat_model' => 'm'];

        (new mistral($this->mock_base_factory, $config + ['reasoning_effort' => 'low']))
            ->chat_completion([new message('user', 'hi')]);
        (new mistral($this->mock_base_factory, $config + ['reasoning_effort' => 'low']))
            ->chat_completion_with_tools([new message('user', 'hi')], []);
        (new openai($this->mock_base_factory, $config))->chat_completion([new message('user', 'hi')]);

        $this->assertSame('low', $sent[0]['reasoning_effort']);
        $this->assertSame('low', $sent[1]['reasoning_effort']);
        $this->assertArrayNotHasKey('reasoning_effort', $sent[2]);
    }

    public function test_bad_response_throws(): void
    {
        $this->mock_curl->method('post')->willReturn('{"error":"nope"}');
        $this->expectException(invalid_provider_instance_response::class);
        $this->provider(nebius::class)->chat_completion_with_tools([new message('user', 'x')], []);
    }
}
