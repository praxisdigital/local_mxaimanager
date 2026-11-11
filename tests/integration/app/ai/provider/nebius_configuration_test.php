<?php

namespace local_mxaimanager\integration\app\ai\provider;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\factory as base_factory;
use PHPUnit\Framework\Attributes\DataProvider;

class nebius_configuration_test extends \advanced_testcase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->resetAfterTest();
    }

    public static function provider_sources(): array
    {
        return [
            'config.php provider' => [true, ['max_tokens' => 64000], 64000],
            'database provider' => [false, ['max_tokens' => '16000'], 16000],
            'existing config.php provider' => [true, [], 32000],
            'existing database provider' => [false, [], 32000],
            'blank config.php limit' => [true, ['max_tokens' => ''], 32000],
            'cleared database limit' => [false, ['max_tokens' => ''], 32000],
        ];
    }

    #[DataProvider('provider_sources')]
    public function test_provider_configuration_reaches_chat_request(bool $preconfigured, array $options, int $expected): void
    {
        global $CFG;

        $curl = $this->createMock(\curl::class);
        $factory = $this->getMockBuilder(base_factory::class)->onlyMethods(['curl'])->getMock();
        $factory->method('curl')->willReturn($curl);
        $config = array_merge([
            'name' => 'Nebius test',
            'classname' => nebius::class,
            'base_url' => 'https://api.tokenfactory.nebius.com',
            'api_key' => 'test_key',
            'chat_model' => 'Qwen/Qwen3.8-27B',
            'embedding_model' => 'Qwen/Qwen3-Embedding-8B',
        ], $options);
        $repository = $factory->ai()->provider()->repository();

        if ($preconfigured) {
            $CFG->local_mxaimanager_preconfigured_providers = [$config];
            $provider = $repository->get_by_id(-1);
            $this->assertTrue($provider->get_is_preconfigured());
        } else {
            $provider = $factory->ai()->provider()->entity()
                ->set_name($config['name'])
                ->set_classname(nebius::class)
                ->set_config_json(json_encode(array_diff_key($config, array_flip(['name', 'classname'])), JSON_THROW_ON_ERROR))
                ->set_timecreated(time())
                ->set_timemodified(time());
            $id = $repository->insert($provider);
            $provider = $repository->get_by_id($id);
        }

        $curl->expects($this->once())->method('post')->willReturnCallback(
            function (string $url, string $body) use ($expected): string {
                $this->assertSame('https://api.tokenfactory.nebius.com/v1/chat/completions', $url);
                $payload = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertSame($expected, $payload['max_tokens']);
                $this->assertArrayNotHasKey('chat_template_kwargs', $payload);
                return '{"choices":[{"message":{"content":"Feedback"},"finish_reason":"stop"}],"usage":{"prompt_tokens":10,"completion_tokens":20}}';
            }
        );

        $handler = new nebius($factory, json_decode($provider->get_config_json(), true, 512, JSON_THROW_ON_ERROR));
        $response = $handler->chat_completion([['role' => 'user', 'content' => 'Generate feedback.']]);

        $this->assertSame('Feedback', $response->get_response());
        $this->assertSame($expected, $response->get_request_json()['max_tokens']);
    }
}
