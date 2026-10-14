<?php

namespace local_mxaimanager\app\ai\agent;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * Outcome of an agent run.
 */
class result implements \JsonSerializable
{
    public const STOP_FINAL_ANSWER = 'final_answer';
    public const STOP_TOOLS_DONE = 'tools_done';
    public const STOP_MAX_STEPS = 'max_steps';

    protected string $text;
    protected int $steps;
    protected array $tool_log;
    protected int $input_tokens;
    protected int $output_tokens;
    protected string $stop_reason;

    /**
     * @param string $text Last non-empty text the model wrote.
     * @param int $steps Model calls made.
     * @param array[] $tool_log One entry per tool call: name, arguments, ok, result.
     */
    public function __construct(
        string $text,
        int $steps,
        array $tool_log,
        int $input_tokens,
        int $output_tokens,
        string $stop_reason
    ) {
        $this->text = $text;
        $this->steps = $steps;
        $this->tool_log = $tool_log;
        $this->input_tokens = $input_tokens;
        $this->output_tokens = $output_tokens;
        $this->stop_reason = $stop_reason;
    }

    public function get_text(): string
    {
        return $this->text;
    }

    public function get_steps(): int
    {
        return $this->steps;
    }

    public function get_tool_log(): array
    {
        return $this->tool_log;
    }

    public function get_input_tokens(): int
    {
        return $this->input_tokens;
    }

    public function get_output_tokens(): int
    {
        return $this->output_tokens;
    }

    public function get_stop_reason(): string
    {
        return $this->stop_reason;
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'steps' => $this->steps,
            'tool_log' => $this->tool_log,
            'input_tokens' => $this->input_tokens,
            'output_tokens' => $this->output_tokens,
            'stop_reason' => $this->stop_reason,
        ];
    }
}
