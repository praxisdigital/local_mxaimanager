<?php

namespace local_mxaimanager\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

/** A message or native tool request from the model, never an execution receipt. */
final class tool_chat_turn
{
    public function __construct(
        public readonly string $text,
        public readonly array $calls,
        public readonly string $binding,
        public readonly string $finish_reason,
        public readonly int $input_tokens,
        public readonly int $output_tokens,
    ) {
    }
}
