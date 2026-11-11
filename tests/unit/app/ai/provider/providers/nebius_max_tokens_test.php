<?php

namespace local_mxaimanager\unit\app\ai\provider\providers;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once $CFG->libdir . '/formslib.php';

use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\exceptions\invalid_provider_instance_configuration;
use local_mxaimanager\app\factory as base_factory;
use PHPUnit\Framework\Attributes\DataProvider;

class nebius_max_tokens_test extends \base_testcase
{
    private const CONFIG = [
        'base_url' => 'https://api.tokenfactory.nebius.com',
        'api_key' => 'test_key',
        'chat_model' => 'Qwen/Qwen3.8-27B',
        'embedding_model' => 'Qwen/Qwen3-Embedding-8B',
    ];

    public static function valid_limits(): array
    {
        return [
            'omitted' => [[], 32000],
            'null uses default' => [['max_tokens' => null], 32000],
            'custom integer' => [['max_tokens' => 64000], 64000],
            'form string' => [['max_tokens' => '16000'], 16000],
            'minimum' => [['max_tokens' => 1], 1],
        ];
    }

    #[DataProvider('valid_limits')]
    public function test_chat_payload_uses_configured_limit(array $options, int $expected): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(base_factory::class);
        $factory->method('curl')->willReturn($curl);
        $curl->expects($this->exactly(3))->method('post')->willReturnCallback(
            function (string $url, string $body) use ($expected): string {
                $payload = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertSame(self::CONFIG['base_url'] . '/v1/chat/completions', $url);
                $this->assertSame($expected, $payload['max_tokens']);
                $this->assertSame(self::CONFIG['chat_model'], $payload['model']);
                $this->assertArrayNotHasKey('chat_template_kwargs', $payload);
                return json_encode([
                    'choices' => [['message' => ['content' => 'Complete answer'], 'finish_reason' => 'stop']],
                    'usage' => ['prompt_tokens' => 20, 'completion_tokens' => 100],
                ], JSON_THROW_ON_ERROR);
            }
        );

        $provider = new nebius($factory, array_merge(self::CONFIG, $options));
        $messages = [['role' => 'user', 'content' => 'Generate feedback.']];
        $schema = ['type' => 'object', 'properties' => ['feedback' => ['type' => 'string']]];
        $text = $provider->chat_completion($messages);
        $json = $provider->chat_completion($messages, true);
        $structured = $provider->chat_completion($messages, false, $schema);

        foreach ([$text, $json, $structured] as $request) {
            $this->assertSame($expected, $request->get_request_json()['max_tokens']);
            $this->assertSame('Complete answer', $request->get_response());
        }
        $this->assertArrayNotHasKey('response_format', $text->get_request_json());
        $this->assertSame('json_object', $json->get_request_json()['response_format']['type']);
        $this->assertSame($schema, $structured->get_request_json()['response_format']['json_schema']['schema']);
    }

    public static function invalid_limits(): array
    {
        return [
            'zero' => [0],
            'negative' => [-1],
            'empty' => [''],
            'fraction' => [1.5],
            'fraction string' => ['1.5'],
            'float integer' => [32000.0],
            'text' => ['unlimited'],
            'true' => [true],
            'false' => [false],
            'array' => [[]],
            'overflow' => ['999999999999999999999999999999'],
        ];
    }

    #[DataProvider('invalid_limits')]
    public function test_invalid_config_is_rejected_before_http(mixed $value): void
    {
        $factory = $this->createMock(base_factory::class);
        $factory->expects($this->never())->method('curl');
        $this->expectException(invalid_provider_instance_configuration::class);
        $this->expectExceptionMessage(get_string('nebius_max_tokens_invalid', 'local_mxaimanager'));

        new nebius($factory, array_merge(self::CONFIG, ['max_tokens' => $value]));
    }

    #[DataProvider('invalid_limits')]
    public function test_form_rejects_invalid_limit(mixed $value): void
    {
        $errors = nebius::moodleform_validation($this->form_data(['max_tokens' => $value]), 'nebius_');

        $this->assertSame([
            'nebius_max_tokens' => get_string('nebius_max_tokens_invalid', 'local_mxaimanager'),
        ], $errors);
    }

    #[DataProvider('valid_limits')]
    public function test_form_accepts_valid_limit(array $options, int $expected): void
    {
        $this->assertGreaterThan(0, $expected);
        $this->assertSame([], nebius::moodleform_validation($this->form_data($options), 'nebius_'));
    }

    private function form_data(array $options): array
    {
        $data = [];
        foreach (array_merge(self::CONFIG, $options) as $key => $value) {
            $data['nebius_' . $key] = $value;
        }
        return $data;
    }

    public function test_provider_form_exposes_limit_and_default(): void
    {
        $form = new \MoodleQuickForm('nebius_config', 'post', '');
        nebius::moodleform_definition($form, 'nebius_');

        $field = $form->getElement('nebius_max_tokens');
        $this->assertSame('text', $field->getType());
        $this->assertSame(get_string('nebius_max_tokens', 'local_mxaimanager'), $field->getLabel());
        $this->assertSame(PARAM_RAW_TRIMMED, $form->getCleanType('nebius_max_tokens', '32000'));
        $this->assertEquals(32000, $form->getElementValue('nebius_max_tokens'));
    }

    public function test_embedding_payload_does_not_include_limit(): void
    {
        $curl = $this->createMock(\curl::class);
        $factory = $this->createMock(base_factory::class);
        $factory->method('curl')->willReturn($curl);
        $curl->expects($this->once())->method('post')->with(
            self::CONFIG['base_url'] . '/v1/embeddings',
            $this->callback(function (string $body): bool {
                $payload = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertArrayNotHasKey('max_tokens', $payload);
                return $payload['model'] === self::CONFIG['embedding_model'];
            })
        )->willReturn('{"data":[{"embedding":[0.1]}],"usage":{"prompt_tokens":1,"total_tokens":1}}');

        $provider = new nebius($factory, array_merge(self::CONFIG, ['max_tokens' => 64000]));
        $this->assertSame([0.1], $provider->get_embedding('text', null)->get_response());
    }
}
