<?php

namespace local_mxaimanager\app\ai\provider;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * The assistant turn that requested tool calls, echoed back in the conversation.
 */
class tool_calls_message extends message
{
    /** @var tool_call[] */
    protected array $tool_calls;

    /**
     * @param string $content Any text the model sent alongside the calls.
     * @param tool_call[] $tool_calls
     */
    public function __construct(string $content, array $tool_calls)
    {
        parent::__construct('assistant', $content);
        $this->tool_calls = $tool_calls;
    }

    /**
     * @return tool_call[]
     */
    public function get_tool_calls(): array
    {
        return $this->tool_calls;
    }

    public function jsonSerialize(): array
    {
        return [
            'role' => 'assistant',
            'content' => $this->get_content() === '' ? null : $this->get_content(),
            'tool_calls' => $this->tool_calls,
        ];
    }
}
