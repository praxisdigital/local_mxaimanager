<?php

namespace local_mxaimanager\app\ai\agent;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\tool_calls_message;
use local_mxaimanager\app\ai\provider\tool_completion_request;
use local_mxaimanager\app\ai\provider\tool_result_message;

/**
 * A small tool-using agent loop, built for latency.
 *
 * Each step is one model call. The loop ends when:
 *  - the model answers without tool calls (final_answer),
 *  - every tool call in a step succeeded without needing the model to read the result,
 *    and the optional review hook has nothing to add (tools_done) - so a clean set of
 *    edits costs exactly one model call, with no "I am done" round trip,
 *  - or max_steps is reached.
 * Errors, view results and review feedback go back to the model for another step.
 */
class agent
{
    public const DEFAULT_MAX_STEPS = 6;

    /** @var callable(message[], \local_mxaimanager\app\ai\provider\tool[]): tool_completion_request */
    protected $complete;
    protected int $max_steps;
    protected string $tool_choice;

    /**
     * @param callable $complete Makes one model call: fn(array $messages, array $tools, string $tool_choice): tool_completion_request.
     * @param int $max_steps
     * @param string $tool_choice 'auto', or 'required' when every step must call a tool (e.g. ask or act, never chat).
     */
    public function __construct(callable $complete, int $max_steps = self::DEFAULT_MAX_STEPS, string $tool_choice = 'auto')
    {
        $this->complete = $complete;
        $this->max_steps = max(1, $max_steps);
        $this->tool_choice = $tool_choice;
    }

    /**
     * @param message[] $messages Conversation so far.
     * @param tool_executor[] $executors Tools the model may call.
     * @param callable|null $review fn(): ?string, called after a clean step; return feedback to continue, null to stop.
     */
    public function run(array $messages, array $executors, ?callable $review = null): result
    {
        $by_name = [];
        foreach ($executors as $executor) {
            $by_name[$executor->definition()->get_name()] = $executor;
        }
        $tools = array_map(fn(tool_executor $e) => $e->definition(), array_values($by_name));

        $text = '';
        $log = [];
        $input_tokens = 0;
        $output_tokens = 0;

        for ($step = 1; $step <= $this->max_steps; $step++) {
            $request = ($this->complete)($messages, $tools, $this->tool_choice);
            $input_tokens += $request->get_input_tokens();
            $output_tokens += $request->get_output_tokens();
            if (trim($request->get_response()) !== '') {
                $text = trim($request->get_response());
            }

            $calls = $request->get_tool_calls();
            if (empty($calls)) {
                return new result($text, $step, $log, $input_tokens, $output_tokens, result::STOP_FINAL_ANSWER);
            }

            $messages[] = new tool_calls_message($request->get_response(), $calls);
            $followup = false;
            foreach ($calls as $call) {
                $outcome = $this->execute($by_name[$call->get_name()] ?? null, $call->get_name(), $call->get_arguments());
                $followup = $followup || $outcome->needs_followup();
                $log[] = [
                    'step' => $step,
                    'name' => $call->get_name(),
                    'arguments' => $call->get_arguments(),
                    'ok' => $outcome->is_ok(),
                    'result' => $outcome->get_content(),
                ];
                $messages[] = new tool_result_message($call->get_id(), $call->get_name(), $outcome->get_content());
            }

            if (!$followup) {
                $feedback = $review ? $review() : null;
                if ($feedback === null) {
                    return new result($text, $step, $log, $input_tokens, $output_tokens, result::STOP_TOOLS_DONE);
                }
                $messages[] = new message('user', $feedback);
            }
        }

        return new result($text, $this->max_steps, $log, $input_tokens, $output_tokens, result::STOP_MAX_STEPS);
    }

    protected function execute(?tool_executor $executor, string $name, array $arguments): tool_result
    {
        if ($executor === null) {
            return tool_result::error("Unknown tool '{$name}'.");
        }
        try {
            return $executor->execute($arguments);
        } catch (\Throwable $t) {
            return tool_result::error('Tool failed: ' . $t->getMessage());
        }
    }
}
