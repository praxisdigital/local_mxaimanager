<?php

namespace local_mxaimanager\app\ai\provider\providers;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();
// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\create_audio_request;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use local_mxaimanager\app\factory as base_factory;

/**
 * ElevenLabs provider: text-to-speech plus Conversational AI helpers.
 *
 * Implements create_audio (TTS). ConvAI agent lifecycle methods are provider-specific
 * helpers for consumers such as mod_mxlangpartner (not standard action interfaces).
 */
class elevenlabs extends provider implements interfaces\create_audio
{
    private const DEFAULT_BASE_URL = 'https://api.elevenlabs.io';
    private const DEFAULT_TTS_MODEL = 'eleven_multilingual_v2';
    private const DEFAULT_TTS_FORMAT = 'mp3_44100_128';
    private const TTS_ALLOWED_FORMATS = [
        'mp3_44100_128',
        'mp3_44100_192',
        'mp3_22050_32',
        'pcm_16000',
        'pcm_22050',
        'pcm_24000',
        'pcm_44100',
        'ulaw_8000',
    ];

    private \curl $curl;
    private string $base_url;
    private string $api_key;
    private string $tts_voice;
    private string $tts_model;
    private string $tts_format;

    /**
     * @throws invalid_provider_instance_configuration
     */
    public function __construct(base_factory $base_factory, array $json_config)
    {
        $this->base_factory = $base_factory;
        $this->base_url = rtrim((string) ($json_config['base_url'] ?? self::DEFAULT_BASE_URL), '/');
        $this->api_key = (string) ($json_config['api_key'] ?? '');
        // Accept both tts_voice (form/config convention) and voice_id (ElevenLabs naming).
        $this->tts_voice = (string) ($json_config['tts_voice'] ?? $json_config['voice_id'] ?? '');
        $this->tts_model = (string) ($json_config['tts_model'] ?? self::DEFAULT_TTS_MODEL);
        $this->tts_format = (string) ($json_config['tts_format'] ?? self::DEFAULT_TTS_FORMAT);

        if ($this->base_url === '' || $this->api_key === '') {
            throw new invalid_provider_instance_configuration('ElevenLabs is missing base url and/or api key');
        }

        $this->curl = $this->base_factory->curl();
        $this->curl->setHeader([
            "xi-api-key: {$this->api_key}",
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
    }

    /**
     * Voice id configured on this provider instance (for ConvAI TTS settings).
     */
    public function get_tts_voice(): string
    {
        return $this->tts_voice;
    }

    /**
     * TTS model id configured on this provider instance.
     */
    public function get_tts_model(): string
    {
        return $this->tts_model !== '' ? $this->tts_model : self::DEFAULT_TTS_MODEL;
    }

    private static function add_tts_voice_field(\MoodleQuickForm $mform, string $element_name_prefix): void
    {
        $mform->addElement(
            'text',
            "{$element_name_prefix}tts_voice",
            get_string('default_tts_voice', 'local_mxaimanager'),
            [
                'action' => interfaces\create_audio::class,
            ]
        );
        $mform->setType("{$element_name_prefix}tts_voice", PARAM_TEXT);
        $mform->addHelpButton("{$element_name_prefix}tts_voice", 'elevenlabs_tts_voice', 'local_mxaimanager');
    }

    private static function add_tts_model_field(\MoodleQuickForm $mform, string $element_name_prefix): void
    {
        $mform->addElement(
            'text',
            "{$element_name_prefix}tts_model",
            get_string('default_tts_model', 'local_mxaimanager'),
            [
                'action' => interfaces\create_audio::class,
            ]
        );
        $mform->setType("{$element_name_prefix}tts_model", PARAM_TEXT);
        $mform->setDefault("{$element_name_prefix}tts_model", self::DEFAULT_TTS_MODEL);
        $mform->addHelpButton("{$element_name_prefix}tts_model", 'elevenlabs_tts_model', 'local_mxaimanager');
    }

    private static function add_tts_format_field(\MoodleQuickForm $mform, string $element_name_prefix): void
    {
        $options = array_combine(self::TTS_ALLOWED_FORMATS, self::TTS_ALLOWED_FORMATS);
        $mform->addElement(
            'select',
            "{$element_name_prefix}tts_format",
            get_string('default_tts_format', 'local_mxaimanager'),
            $options,
            [
                'action' => interfaces\create_audio::class,
            ]
        );
        $mform->setDefault("{$element_name_prefix}tts_format", self::DEFAULT_TTS_FORMAT);
        $mform->addHelpButton("{$element_name_prefix}tts_format", 'elevenlabs_tts_format', 'local_mxaimanager');
    }

    public static function moodleform_definition(\MoodleQuickForm $mform, string $element_name_prefix): void
    {
        $mform->addElement('text', "{$element_name_prefix}base_url", get_string('base_url', 'local_mxaimanager'));
        $mform->setType("{$element_name_prefix}base_url", PARAM_URL);
        $mform->setDefault("{$element_name_prefix}base_url", self::DEFAULT_BASE_URL);

        $mform->addElement('text', "{$element_name_prefix}api_key", get_string('api_key', 'local_mxaimanager'));
        $mform->setType("{$element_name_prefix}api_key", PARAM_TEXT);
        $mform->setDefault("{$element_name_prefix}api_key", '');
        $mform->addHelpButton("{$element_name_prefix}api_key", 'elevenlabs_api_key', 'local_mxaimanager');

        self::add_tts_voice_field($mform, $element_name_prefix);
        self::add_tts_model_field($mform, $element_name_prefix);
        self::add_tts_format_field($mform, $element_name_prefix);
    }

    public static function moodleform_validation(array $data, string $element_name_prefix): array
    {
        $errors = [];

        if (empty($data["{$element_name_prefix}base_url"])) {
            $errors["{$element_name_prefix}base_url"] = get_string('required');
        }

        if (empty($data["{$element_name_prefix}api_key"])) {
            $errors["{$element_name_prefix}api_key"] = get_string('required');
        }

        if (empty($data["{$element_name_prefix}tts_voice"])) {
            $errors["{$element_name_prefix}tts_voice"] = get_string('required');
        }

        return $errors;
    }

    public static function action_moodleform_definition(
        \MoodleQuickForm $mform,
        string $interface,
        string $element_name_prefix
    ): void {
        if ($interface === interfaces\create_audio::class) {
            self::add_tts_voice_field($mform, $element_name_prefix);
            self::add_tts_model_field($mform, $element_name_prefix);
            self::add_tts_format_field($mform, $element_name_prefix);
        }
    }

    /**
     * @throws invalid_provider_instance_configuration
     * @throws invalid_provider_instance_response
     */
    public function create_audio(string $text): create_audio_request
    {
        if ($this->tts_voice === '') {
            throw new invalid_provider_instance_configuration('ElevenLabs TTS voice id is not configured');
        }

        $model = $this->tts_model !== '' ? $this->tts_model : self::DEFAULT_TTS_MODEL;
        $format = $this->tts_format !== '' ? $this->tts_format : self::DEFAULT_TTS_FORMAT;
        if (!in_array($format, self::TTS_ALLOWED_FORMATS, true)) {
            throw new invalid_provider_instance_configuration(
                'TTS format "' . $format . '" is not supported by ElevenLabs provider. Allowed: '
                . implode(', ', self::TTS_ALLOWED_FORMATS)
            );
        }

        $payload = [
            'text' => $text,
            'model_id' => $model,
        ];

        $url = $this->base_url . '/v1/text-to-speech/' . rawurlencode($this->tts_voice)
            . '?output_format=' . rawurlencode($format);

        try {
            // Prefer binary audio over JSON error bodies.
            $this->curl->setHeader(['Accept: audio/*, application/octet-stream, */*']);
            $response = $this->curl->post($url, json_encode($payload, JSON_THROW_ON_ERROR));

            $decoded = json_decode($response, true);
            if (is_array($decoded) && (isset($decoded['detail']) || isset($decoded['error']))) {
                throw new \Exception('ElevenLabs TTS error: ' . json_encode($decoded));
            }

            if ($response === '' || $response === false) {
                throw new \Exception('Empty audio response from ElevenLabs TTS');
            }

            return new create_audio_request(
                $payload + ['voice_id' => $this->tts_voice, 'output_format' => $format],
                [],
                base64_encode($response),
                0,
                0
            );
        } catch (\Throwable $t) {
            throw new invalid_provider_instance_response(
                'Invalid response from ElevenLabs: ' . $t->getMessage(),
                previous: $t
            );
        }
    }

    /**
     * Creates an ephemeral Conversational AI agent.
     *
     * @param string $name human-readable agent name
     * @param array $conversationconfig ElevenLabs conversation_config structure
     * @return string agent id
     * @throws invalid_provider_instance_response
     */
    public function create_conversational_agent(string $name, array $conversationconfig): string
    {
        $body = [
            'name' => $name,
            'conversation_config' => $conversationconfig,
        ];
        $response = $this->request_json('POST', '/v1/convai/agents/create', $body);
        $agentid = $response['agent_id'] ?? $response['id'] ?? null;
        if (!$agentid) {
            throw new invalid_provider_instance_response('ElevenLabs did not return an agent id');
        }
        return (string) $agentid;
    }

    /**
     * Returns a signed WebSocket URL for the given Conversational AI agent.
     *
     * @throws invalid_provider_instance_response
     */
    public function get_signed_conversation_url(string $agentid): string
    {
        $response = $this->request_json(
            'GET',
            '/v1/convai/conversation/get-signed-url?agent_id=' . rawurlencode($agentid)
        );
        $signedurl = $response['signed_url'] ?? null;
        if (!$signedurl) {
            throw new invalid_provider_instance_response('ElevenLabs did not return a signed conversation URL');
        }
        return (string) $signedurl;
    }

    /**
     * Best-effort deletion of an ephemeral Conversational AI agent.
     */
    public function delete_conversational_agent(string $agentid): void
    {
        try {
            $this->request_json('DELETE', '/v1/convai/agents/' . rawurlencode($agentid));
        } catch (\Throwable $e) {
            debugging(
                'local_mxaimanager: failed to delete ElevenLabs agent ' . $agentid . ': ' . $e->getMessage(),
                DEBUG_DEVELOPER
            );
        }
    }

    /**
     * Authenticated JSON request against the ElevenLabs HTTP API.
     *
     * @return array decoded JSON (empty array if no body)
     * @throws invalid_provider_instance_response
     */
    protected function request_json(string $method, string $path, ?array $body = null): array
    {
        $this->curl->setHeader([
            "xi-api-key: {$this->api_key}",
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $url = $this->base_url . $path;
        $options = ['CURLOPT_CUSTOMREQUEST' => $method];

        if ($body !== null) {
            $rawresponse = $this->curl->post($url, json_encode($body, JSON_THROW_ON_ERROR), $options);
        } else if ($method === 'DELETE') {
            $rawresponse = $this->curl->delete($url, [], $options);
        } else {
            $rawresponse = $this->curl->get($url, [], $options);
        }

        $info = $this->curl->get_info();
        $httpcode = (int) ($info['http_code'] ?? 0);
        if ($httpcode < 200 || $httpcode >= 300) {
            throw new invalid_provider_instance_response(
                "ElevenLabs HTTP $httpcode: " . (string) $rawresponse
            );
        }

        if ($rawresponse === '' || $rawresponse === null || $rawresponse === false) {
            return [];
        }

        try {
            $decoded = json_decode((string) $rawresponse, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new invalid_provider_instance_response(
                'Invalid JSON response from ElevenLabs: ' . $e->getMessage(),
                previous: $e
            );
        }

        if (!is_array($decoded)) {
            throw new invalid_provider_instance_response(
                'Invalid JSON response from ElevenLabs: expected object or array'
            );
        }

        return $decoded;
    }
}
