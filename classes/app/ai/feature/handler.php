<?php

namespace local_mxaimanager\app\ai\feature;


// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\agent\result as agent_result;
use local_mxaimanager\app\ai\agent\tool_executor;
use local_mxaimanager\app\ai\provider\message;
use local_mxaimanager\app\ai\provider\tool;
use local_mxaimanager\app\ai\provider\tool_completion_request;
use local_mxaimanager\app\ai\provider\create_transcription_request;
use local_mxaimanager\app\ai\provider\transcription;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use local_mxaimanager\app\exceptions\no_provider_instance_configured;
use local_mxaimanager\app\factory as base_factory;

class handler
{
    private base_factory $base_factory;
    private provider_resolver $provider_resolver;
    private action_handler $action_handler;
    private entity $feature;

    public function __construct(base_factory $base_factory, entity $feature)
    {
        $this->base_factory = $base_factory;
        $this->feature = $feature;
        $this->provider_resolver = $this->base_factory->ai()->feature()->provider_resolver(
            $base_factory,
            $this->feature
        );
        $this->action_handler = $this->base_factory->ai()->feature()->action_handler($base_factory);
    }

    /**
     * @param message[] $messages
     * @param bool $json_mode Whether to enable JSON mode (forces the response to be valid JSON).
     * @param array|null $json_schema Optional JSON schema to enforce structured output (implies JSON mode).
     * @return string
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function chat_completion(array $messages, bool $json_mode = false, ?array $json_schema = null): string
    {
        // Get provider_id and settings_json for the action.
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion::class
        );

        return $this->action_handler->chat_completion(
            $this->feature,
            $messages,
            $json_mode,
            $json_schema,
            $provider_id,
            $config_json
        );
    }

    /**
     * Whether the provider configured for this feature's chat completion supports tool calling.
     */
    public function supports_tool_calling(): bool
    {
        try {
            [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
                \local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion::class
            );
        } catch (\Throwable $t) {
            return false;
        }
        return $this->action_handler->supports_tool_calling($provider_id, $config_json);
    }

    /**
     * One chat completion with tools, using this feature's chat completion provider and model.
     *
     * @param message[] $messages
     * @param tool[] $tools
     * @param string $tool_choice 'auto', 'none' or 'required'.
     * @return tool_completion_request
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function chat_completion_with_tools(
        array $messages,
        array $tools,
        string $tool_choice = 'auto'
    ): tool_completion_request {
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion::class
        );

        return $this->action_handler->chat_completion_with_tools(
            $this->feature,
            $messages,
            $tools,
            $tool_choice,
            $provider_id,
            $config_json
        );
    }

    /**
     * Runs a tool-using agent loop on this feature's provider. Every model call is logged.
     *
     * @param message[] $messages
     * @param tool_executor[] $executors
     * @param callable|null $review fn(): ?string, see agent::run().
     * @param int $max_steps
     * @param string $tool_choice 'auto', or 'required' to force a tool call on every step.
     * @return agent_result
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function run_agent(
        array $messages,
        array $executors,
        ?callable $review = null,
        int $max_steps = \local_mxaimanager\app\ai\agent\agent::DEFAULT_MAX_STEPS,
        string $tool_choice = 'auto'
    ): agent_result {
        $agent = $this->base_factory->ai()->agent(
            fn(array $messages, array $tools, string $choice) => $this->chat_completion_with_tools($messages, $tools, $choice),
            $max_steps,
            $tool_choice
        );
        return $agent->run($messages, $executors, $review);
    }

    /**
     * @param string $input
     * @param int $dimension
     * @return float[]
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function create_embedding(string $input, int $dimension): array
    {
        // Get provider_id and settings_json for the action.
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\create_embedding::class
        );

        return $this->action_handler->create_embedding($this->feature, $input, $dimension, $provider_id, $config_json);
    }

    /**
     * @param string $prompt
     * @param bool $return_b64
     * @return string
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function create_image(string $prompt, bool $return_b64 = false): string
    {
        // Get provider_id and settings_json for the action.
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\create_image::class
        );

        return $this->action_handler->create_image(
            $this->feature,
            $prompt,
            $return_b64,
            $provider_id,
            $config_json
        );
    }

    /**
     * @param string $audio_filepath
     * @return transcription
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function create_transcription(string $audio_filepath): transcription
    {
        // Get provider_id and settings_json for the action.
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\create_transcription::class
        );

        return $this->action_handler->create_transcription(
            $this->feature,
            $audio_filepath,
            $provider_id,
            $config_json
        );
    }

    /**
     * Synthesize audio (text-to-speech) from a text input.
     *
     * Returns the base64-encoded audio binary. Mimetype/format is determined by the
     * provider config (`tts_format`).
     *
     * @param string $text
     * @return string Base64-encoded audio.
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     * @throws no_provider_instance_configured
     */
    public function create_audio(string $text): string
    {
        // Get provider_id and settings_json for the action.
        [$provider_id, $config_json] = $this->provider_resolver->get_provider_and_config(
            \local_mxaimanager\app\ai\provider\providers\interfaces\create_audio::class
        );

        return $this->action_handler->create_audio(
            $this->feature,
            $text,
            $provider_id,
            $config_json
        );
    }
}
