<?php

namespace local_mxaimanager\unit\app\ai\feature;


// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use base_testcase;
use local_mxaimanager\app\factory as base_factory;
use local_mxaimanager\app\ai\action\entity as action_entity;
use local_mxaimanager\app\ai\factory as ai_factory;
use local_mxaimanager\app\ai\feature\factory as feature_factory;
use local_mxaimanager\app\ai\feature\entity;
use local_mxaimanager\app\ai\feature\handler;
use local_mxaimanager\app\ai\feature\provider_resolver;
use local_mxaimanager\app\ai\feature\action_handler;
use local_mxaimanager\app\ai\provider\tool_chat_request;
use local_mxaimanager\app\ai\provider\tool_chat_turn;

class handler_test extends base_testcase
{
    public function test_complete_tools_uses_chat_configuration_and_passes_binding(): void
    {
        $resolver = $this->createMock(provider_resolver::class);
        $resolver->expects($this->once())->method('get_provider_and_config')
            ->with(\local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion::class)
            ->willReturn([7, ['chat_model' => 'example']]);
        $actions = $this->createMock(action_handler::class);
        $feature = new entity();
        $messages = [['role' => 'user', 'content' => 'Hi']];
        $tools = [['name' => 'lookup', 'description' => 'Look up', 'parameters' => ['type' => 'object']]];
        $result = ['text' => '', 'calls' => [], 'binding' => 'bound', 'finish_reason' => 'stop',
            'input_tokens' => 10, 'output_tokens' => 2];
        $actions->expects($this->once())->method('complete_tools')
            ->with($feature, $messages, $tools, 'bound', 7, ['chat_model' => 'example'])->willReturn($result);
        $base = $this->createMock(base_factory::class);
        $ai = $this->createMock(ai_factory::class);
        $featurefactory = $this->createMock(feature_factory::class);
        $base->method('ai')->willReturn($ai);
        $ai->method('feature')->willReturn($featurefactory);
        $featurefactory->method('provider_resolver')->willReturn($resolver);
        $featurefactory->method('action_handler')->willReturn($actions);
        $turn = (new handler($base, $feature))->complete(new tool_chat_request($messages, $tools, 'bound'));
        $this->assertInstanceOf(tool_chat_turn::class, $turn);
        $this->assertSame($result, get_object_vars($turn));
    }

    public function test_chat_completion(): void
    {
        // Set up mocks
        $provider_resolver_mock = $this->createMock(provider_resolver::class);
        $action_handler_mock = $this->createMock(action_handler::class);

        // Configure the provider resolver to return expected values
        $provider_resolver_mock->expects($this->once())
            ->method('get_provider_and_config')
            ->with(\local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion::class)
            ->willReturn([1, ['key' => 'value']]);

        // Configure an action handler to return expected chat completion
        $action_handler_mock->expects($this->once())
            ->method('chat_completion')
            ->with(
                $this->isInstanceOf(entity::class),
                $this->equalTo([['role' => 'user', 'content' => 'Test']]),
                $this->equalTo(false),
                $this->equalTo(null),
                $this->equalTo(1),
                $this->equalTo(['key' => 'value'])
            )
            ->willReturn('Assistant response');

        // Create mock chains
        $base_factory_mock = $this->createMock(base_factory::class);
        $ai_factory_mock = $this->createMock(ai_factory::class);
        $feature_factory_mock = $this->createMock(feature_factory::class);

        // Set up a factory chain
        $base_factory_mock->expects($this->exactly(2)) // 2 in constructor + 0 in method, assuming no more actions
        ->method('ai')
            ->willReturn($ai_factory_mock);

        $ai_factory_mock->expects($this->exactly(2))
            ->method('feature')
            ->willReturn($feature_factory_mock);

        $feature_factory_mock->expects($this->once())
            ->method('provider_resolver')
            ->willReturn($provider_resolver_mock);

        $feature_factory_mock->expects($this->once())
            ->method('action_handler')
            ->willReturn($action_handler_mock);

        // Create a mock feature entity
        $feature_entity_mock = $this->createMock(entity::class);

        // Instantiate handler
        $handler = new handler($base_factory_mock, $feature_entity_mock);

        // Execute test
        $messages = [['role' => 'user', 'content' => 'Test']];
        $result = $handler->chat_completion($messages);

        // Assert results
        $this->assertEquals('Assistant response', $result);
    }

    public function test_create_embedding(): void
    {
        // Set up mocks
        $provider_resolver_mock = $this->createMock(provider_resolver::class);
        $action_handler_mock = $this->createMock(action_handler::class);

        // Configure the provider resolver to return expected values
        $provider_resolver_mock->expects($this->once())
            ->method('get_provider_and_config')
            ->with(\local_mxaimanager\app\ai\provider\providers\interfaces\create_embedding::class)
            ->willReturn([2, ['model' => 'text']]);

        // Configure an action handler to return expected embedding
        $action_handler_mock->expects($this->once())
            ->method('create_embedding')
            ->with(
                $this->isInstanceOf(entity::class),
                $this->equalTo('Hello world'),
                $this->equalTo(1536),
                $this->equalTo(2),
                $this->equalTo(['model' => 'text'])
            )
            ->willReturn([0.1, 0.2, 0.3]);

        // Create mock chains
        $base_factory_mock = $this->createMock(base_factory::class);
        $ai_factory_mock = $this->createMock(ai_factory::class);
        $feature_factory_mock = $this->createMock(feature_factory::class);

        // Set up a factory chain
        $base_factory_mock->expects($this->exactly(2)) // 2 in constructor + 0 in method
        ->method('ai')
            ->willReturn($ai_factory_mock);

        $ai_factory_mock->expects($this->exactly(2))
            ->method('feature')
            ->willReturn($feature_factory_mock);

        $feature_factory_mock->expects($this->once())
            ->method('provider_resolver')
            ->willReturn($provider_resolver_mock);

        $feature_factory_mock->expects($this->once())
            ->method('action_handler')
            ->willReturn($action_handler_mock);

        // Create a mock feature entity
        $feature_entity_mock = $this->createMock(entity::class);

        // Instantiate handler
        $handler = new handler($base_factory_mock, $feature_entity_mock);

        // Execute test
        $result = $handler->create_embedding('Hello world', 1536);

        // Assert results
        $this->assertEquals([0.1, 0.2, 0.3], $result);
    }

    public function test_create_audio(): void
    {
        $provider_resolver_mock = $this->createMock(provider_resolver::class);
        $action_handler_mock = $this->createMock(action_handler::class);

        $provider_resolver_mock->expects($this->once())
            ->method('get_provider_and_config')
            ->with(\local_mxaimanager\app\ai\provider\providers\interfaces\create_audio::class)
            ->willReturn([7, ['tts_model' => 'tts-1']]);

        $action_handler_mock->expects($this->once())
            ->method('create_audio')
            ->with(
                $this->isInstanceOf(entity::class),
                $this->equalTo('Hola mundo'),
                $this->equalTo(7),
                $this->equalTo(['tts_model' => 'tts-1'])
            )
            ->willReturn('base64audiopayload');

        $base_factory_mock = $this->createMock(base_factory::class);
        $ai_factory_mock = $this->createMock(ai_factory::class);
        $feature_factory_mock = $this->createMock(feature_factory::class);

        $base_factory_mock->expects($this->exactly(2))
            ->method('ai')
            ->willReturn($ai_factory_mock);

        $ai_factory_mock->expects($this->exactly(2))
            ->method('feature')
            ->willReturn($feature_factory_mock);

        $feature_factory_mock->expects($this->once())
            ->method('provider_resolver')
            ->willReturn($provider_resolver_mock);

        $feature_factory_mock->expects($this->once())
            ->method('action_handler')
            ->willReturn($action_handler_mock);

        $feature_entity_mock = $this->createMock(entity::class);

        $handler = new handler($base_factory_mock, $feature_entity_mock);

        $result = $handler->create_audio('Hola mundo');

        $this->assertEquals('base64audiopayload', $result);
    }
}
