<?php

namespace local_mxaimanager\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

/** Chat usage record with the canonical tool calls returned by the provider. */
class tool_completion_request extends chat_completion_request
{
    private const FAILED_FINISH_REASONS = ['length', 'max_tokens', 'model_length', 'content_filter', 'error'];

    private array $calls;

    public function __construct(
        array $request, array $response, string $text, array $calls, int $input, int $output, string $finish
    ) {
        parent::__construct($request, $response, $text, $input, $output, $finish);
        $this->calls = $calls;
    }

    public function get_calls(): array
    {
        return $this->calls;
    }

    public static function has_failed_finish_reason(string $finish): bool
    {
        return in_array($finish, self::FAILED_FINISH_REASONS, true);
    }
}
