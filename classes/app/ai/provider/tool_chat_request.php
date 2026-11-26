<?php

namespace local_mxaimanager\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

/** One provider-independent chat turn, optionally carrying a native tool exchange. */
final class tool_chat_request
{
    public function __construct(
        public readonly array $messages,
        public readonly array $tools,
        public readonly ?string $binding = null,
    ) {
    }
}
