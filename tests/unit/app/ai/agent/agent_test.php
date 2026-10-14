<?php

namespace local_mxaimanager\unit\app\ai\agent;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\agent\agent;
use local_mxaimanager\app\ai\agent\result;
use local_mxaimanager\app\ai\agent\tool_executor;
use local_mxaimanager\app\ai\agent\tool_result;
use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\tool;
use local_mxaimanager\app\ai\provider\tool_call;
use local_mxaimanager\app\ai\provider\tool_completion_request;
use local_mxaimanager\app\ai\provider\tool_result_message;

/**
 * @covers \local_mxaimanager\app\ai\agent\agent
 * @covers \local_mxaimanager\app\ai\agent\tool_result
 * @covers \local_mxaimanager\app\ai\agent\result
 */
class agent_test extends \base_testcase
{
    /**
     * A scripted model: returns the given responses in order and records what it was sent.
     *
     * @param array $responses Each: ['text' => string, 'calls' => [[name, arguments]]].
     * @param array $seen Receives the message lists.
     */
    private function model(array $responses, array &$seen): callable
    {
        return function (array $messages, array $tools) use (&$responses, &$seen) {
            $seen[] = $messages;
            $next = array_shift($responses);
            $calls = [];
            foreach ($next['calls'] ?? [] as $i => [$name, $args]) {
                $calls[] = new tool_call('call_' . count($seen) . '_' . $i, $name, $args, json_encode($args));
            }
            return new tool_completion_request([], [], $next['text'] ?? '', 100, 10, 'stop', $calls);
        };
    }

    /**
     * A tool that records calls and fails when told to.
     */
    private function tool(string $name, array &$calls, bool $followup = false): tool_executor
    {
        return new class ($name, $calls, $followup) implements tool_executor {
            public function __construct(private string $name, private array &$calls, private bool $followup)
            {
            }

            public function definition(): tool
            {
                return new tool($this->name, 'test', ['type' => 'object', 'properties' => new \stdClass()]);
            }

            public function execute(array $arguments): tool_result
            {
                $this->calls[] = $arguments;
                if (!empty($arguments['fail'])) {
                    return tool_result::error('failed');
                }
                return $this->followup ? tool_result::info('data') : tool_result::done();
            }
        };
    }

    public function test_clean_tool_calls_stop_after_one_model_call(): void
    {
        $seen = [];
        $calls = [];
        $agent = new agent($this->model([
            ['text' => 'Renamed it.', 'calls' => [['edit', ['a' => 1]], ['edit', ['a' => 2]]]],
        ], $seen));

        $result = $agent->run([new message('user', 'go')], [$this->tool('edit', $calls)]);

        $this->assertSame(1, $result->get_steps());
        $this->assertSame(result::STOP_TOOLS_DONE, $result->get_stop_reason());
        $this->assertSame('Renamed it.', $result->get_text());
        $this->assertCount(2, $calls);
        $this->assertCount(1, $seen);
        $this->assertSame(100, $result->get_input_tokens());
    }

    public function test_tool_error_goes_back_to_the_model(): void
    {
        $seen = [];
        $calls = [];
        $agent = new agent($this->model([
            ['calls' => [['edit', ['fail' => true]]]],
            ['text' => 'Fixed.', 'calls' => [['edit', ['a' => 1]]]],
        ], $seen));

        $result = $agent->run([new message('user', 'go')], [$this->tool('edit', $calls)]);

        $this->assertSame(2, $result->get_steps());
        $this->assertSame(result::STOP_TOOLS_DONE, $result->get_stop_reason());
        $last = end($seen[1]);
        $this->assertInstanceOf(tool_result_message::class, $last);
        $this->assertSame('failed', $last->get_content());
        $this->assertFalse($result->get_tool_log()[0]['ok']);
    }

    public function test_info_result_continues_until_final_answer(): void
    {
        $seen = [];
        $calls = [];
        $agent = new agent($this->model([
            ['calls' => [['view', []]]],
            ['text' => 'It says hello.'],
        ], $seen));

        $result = $agent->run([new message('user', 'go')], [$this->tool('view', $calls, true)]);

        $this->assertSame(2, $result->get_steps());
        $this->assertSame(result::STOP_FINAL_ANSWER, $result->get_stop_reason());
        $this->assertSame('It says hello.', $result->get_text());
    }

    public function test_review_feedback_adds_a_step(): void
    {
        $seen = [];
        $calls = [];
        $reviews = 0;
        $agent = new agent($this->model([
            ['calls' => [['edit', ['a' => 1]]]],
            ['calls' => [['edit', ['a' => 2]]]],
        ], $seen));

        $result = $agent->run([new message('user', 'go')], [$this->tool('edit', $calls)], function () use (&$reviews) {
            return ++$reviews === 1 ? 'You broke something.' : null;
        });

        $this->assertSame(2, $result->get_steps());
        $this->assertSame('You broke something.', end($seen[1])->get_content());
    }

    public function test_unknown_tool_and_max_steps(): void
    {
        $seen = [];
        $agent = new agent($this->model([
            ['calls' => [['nope', []]]],
            ['calls' => [['nope', []]]],
        ], $seen), 2);

        $result = $agent->run([new message('user', 'go')], []);

        $this->assertSame(result::STOP_MAX_STEPS, $result->get_stop_reason());
        $this->assertSame("Unknown tool 'nope'.", $result->get_tool_log()[0]['result']);
    }
}
