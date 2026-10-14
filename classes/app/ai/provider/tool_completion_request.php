<?php

namespace local_mxaimanager\app\ai\provider;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * A chat completion that may carry tool calls instead of (or as well as) text.
 */
class tool_completion_request extends chat_completion_request
{
    /** @var tool_call[] */
    protected array $tool_calls;

    /**
     * @param tool_call[] $tool_calls
     */
    public function __construct(
        array $request_json,
        array $response_json,
        string $response,
        int $input_tokens,
        int $output_tokens,
        string $finish_reason,
        array $tool_calls
    ) {
        parent::__construct($request_json, $response_json, $response, $input_tokens, $output_tokens, $finish_reason);
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
        return parent::jsonSerialize() + ['tool_calls' => $this->tool_calls];
    }
}
