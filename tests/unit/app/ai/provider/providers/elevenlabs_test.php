<?php

namespace local_mxaimanager\unit\app\ai\provider\providers;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();
// @codeCoverageIgnoreEnd

global $CFG;
require_once $CFG->libdir . '/formslib.php';

use local_mxaimanager\app\ai\provider\providers\interfaces\create_audio;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\exceptions\invalid_provider_instance_response;
use PHPUnit\Framework\MockObject\MockObject;

class elevenlabs_test extends \advanced_testcase
{
    private MockObject $mock_base_factory;
    private MockObject $mock_curl;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mock_curl = $this->createMock(\curl::class);
        $this->mock_base_factory = $this->createMock(\local_mxaimanager\app\factory::class);
        $this->mock_base_factory->method('curl')->willReturn($this->mock_curl);
    }

    public function test_constructor_with_valid_config(): void
    {
        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'base_url' => 'https://api.elevenlabs.io',
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $this->assertInstanceOf(\local_mxaimanager\app\ai\provider\providers\elevenlabs::class, $provider);
        $this->assertEquals('voice123', $provider->get_tts_voice());
    }

    public function test_constructor_accepts_voice_id_alias(): void
    {
        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'api_key' => 'test_key',
                'voice_id' => 'alias-voice',
            ]
        );

        $this->assertEquals('alias-voice', $provider->get_tts_voice());
    }

    public function test_constructor_missing_api_key(): void
    {
        $this->expectException(invalid_provider_instance_configuration::class);
        $this->expectExceptionMessage('ElevenLabs is missing base url and/or api key');

        new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            ['base_url' => 'https://api.elevenlabs.io']
        );
    }

    public function test_moodleform_validation_requires_fields(): void
    {
        $errors = \local_mxaimanager\app\ai\provider\providers\elevenlabs::moodleform_validation(
            [],
            'prefix_'
        );

        $this->assertArrayHasKey('prefix_base_url', $errors);
        $this->assertArrayHasKey('prefix_api_key', $errors);
        $this->assertArrayHasKey('prefix_tts_voice', $errors);
    }

    public function test_moodleform_definition_adds_elements(): void
    {
        $mform = $this->createMock(\MoodleQuickForm::class);
        $mform->expects($this->atLeast(5))->method('addElement');
        $mform->expects($this->atLeast(3))->method('setType');

        \local_mxaimanager\app\ai\provider\providers\elevenlabs::moodleform_definition($mform, 'prefix_');
    }

    public function test_action_moodleform_definition_create_audio(): void
    {
        $mform = $this->createMock(\MoodleQuickForm::class);
        $mform->expects($this->atLeast(3))->method('addElement');

        \local_mxaimanager\app\ai\provider\providers\elevenlabs::action_moodleform_definition(
            $mform,
            create_audio::class,
            'prefix_'
        );
    }

    public function test_create_audio_success(): void
    {
        $raw_audio = 'binary-audio-bytes';

        $this->mock_curl->expects($this->once())
            ->method('post')
            ->with(
                'https://api.elevenlabs.io/v1/text-to-speech/voice123?output_format=mp3_44100_128',
                $this->callback(function ($data) {
                    $decoded = json_decode($data, true);
                    return isset($decoded['text'], $decoded['model_id'])
                        && $decoded['text'] === 'Hola mundo'
                        && $decoded['model_id'] === 'eleven_multilingual_v2';
                })
            )
            ->willReturn($raw_audio);

        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'base_url' => 'https://api.elevenlabs.io',
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $result = $provider->create_audio('Hola mundo');

        $this->assertEquals(base64_encode($raw_audio), $result->get_response());
        $this->assertEquals(0, $result->get_input_tokens());
        $this->assertEquals(0, $result->get_output_tokens());
    }

    public function test_create_audio_missing_voice(): void
    {
        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'base_url' => 'https://api.elevenlabs.io',
                'api_key' => 'test_key',
            ]
        );

        $this->expectException(invalid_provider_instance_configuration::class);
        $this->expectExceptionMessage('ElevenLabs TTS voice id is not configured');
        $provider->create_audio('Test');
    }

    public function test_create_audio_json_error_response(): void
    {
        $this->mock_curl->expects($this->once())
            ->method('post')
            ->willReturn(json_encode(['detail' => ['status' => 'quota_exceeded']]));

        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $this->expectException(invalid_provider_instance_response::class);
        $provider->create_audio('Test');
    }

    public function test_create_conversational_agent_success(): void
    {
        $this->mock_curl->expects($this->once())
            ->method('post')
            ->with(
                'https://api.elevenlabs.io/v1/convai/agents/create',
                $this->callback(function ($data) {
                    $decoded = json_decode($data, true);
                    return ($decoded['name'] ?? '') === 'agent-1'
                        && isset($decoded['conversation_config']);
                }),
                $this->anything()
            )
            ->willReturn(json_encode(['agent_id' => 'agt_abc']));

        $this->mock_curl->method('get_info')->willReturn(['http_code' => 200]);

        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $id = $provider->create_conversational_agent('agent-1', ['agent' => ['language' => 'da']]);
        $this->assertEquals('agt_abc', $id);
    }

    public function test_get_signed_conversation_url_success(): void
    {
        $this->mock_curl->expects($this->once())
            ->method('get')
            ->with(
                'https://api.elevenlabs.io/v1/convai/conversation/get-signed-url?agent_id=agt_1',
                $this->anything(),
                $this->anything()
            )
            ->willReturn(json_encode(['signed_url' => 'wss://example.test/ws']));

        $this->mock_curl->method('get_info')->willReturn(['http_code' => 200]);

        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $url = $provider->get_signed_conversation_url('agt_1');
        $this->assertEquals('wss://example.test/ws', $url);
    }

    public function test_delete_conversational_agent_swallows_errors(): void
    {
        $this->mock_curl->expects($this->once())
            ->method('delete')
            ->willThrowException(new \Exception('network'));

        $provider = new \local_mxaimanager\app\ai\provider\providers\elevenlabs(
            $this->mock_base_factory,
            [
                'api_key' => 'test_key',
                'tts_voice' => 'voice123',
            ]
        );

        $provider->delete_conversational_agent('agt_1');
        $this->assertDebuggingCalled(
            'local_mxaimanager: failed to delete ElevenLabs agent agt_1: network',
            DEBUG_DEVELOPER
        );
    }
}
