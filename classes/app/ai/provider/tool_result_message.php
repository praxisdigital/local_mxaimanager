<?php

namespace local_mxaimanager\app\ai\provider;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * The result of one tool call, sent back to the model.
 */
class tool_result_message extends message
{
    protected string $tool_call_id;
    protected string $name;

    public function __construct(string $tool_call_id, string $name, string $content)
    {
        parent::__construct('tool', $content);
        $this->tool_call_id = $tool_call_id;
        $this->name = $name;
    }

    public function get_tool_call_id(): string
    {
        return $this->tool_call_id;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'role' => 'tool',
            'tool_call_id' => $this->tool_call_id,
            'name' => $this->name,
            'content' => $this->get_content(),
        ];
    }
}
