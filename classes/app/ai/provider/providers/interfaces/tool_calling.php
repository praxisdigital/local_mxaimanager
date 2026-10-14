<?php

namespace local_mxaimanager\app\ai\provider\providers\interfaces;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\tool;
use local_mxaimanager\app\ai\provider\tool_completion_request;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;

/**
 * Chat completion with function calling. Uses the provider's chat model, so a feature's
 * existing chat_completion configuration applies; no separate action has to be registered.
 */
interface tool_calling
{
    /**
     * @param message[] $messages May include tool_calls_message and tool_result_message.
     * @param tool[] $tools
     * @param string $tool_choice 'auto', 'none' or 'required'.
     * @return tool_completion_request
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     */
    public function chat_completion_with_tools(
        array $messages,
        array $tools,
        string $tool_choice = 'auto'
    ): tool_completion_request;
}
