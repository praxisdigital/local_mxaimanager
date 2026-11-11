<?php

namespace local_mxaimanager\integration\app\controller;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\ai\provider\providers\interfaces\chat_completion;
use local_mxaimanager\app\ai\provider\providers\interfaces\create_embedding;
use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\controller\manage_providers;
use local_mxaimanager\app\factory as base_factory;
use PHPUnit\Framework\Attributes\DataProvider;

class manage_providers_delete_test extends \advanced_testcase
{
    private base_factory $factory;
    private int $provider_id;
    private array $default_ids = [];
    private array $original_get;
    private array $original_post;

    protected function setUp(): void
    {
        global $CFG;

        parent::setUp();
        $this->resetAfterTest();
        $this->original_get = $_GET;
        $this->original_post = $_POST;
        $_GET = [];
        $_POST = [];
        $CFG->autologinguests = false;
        $this->setUser(0);
        $this->factory = new base_factory();

        $provider = $this->factory->ai()->provider()->entity()
            ->set_name('Deletion security test')
            ->set_classname(nebius::class)
            ->set_timecreated(time())
            ->set_timemodified(time());
        $this->provider_id = $this->factory->ai()->provider()->repository()->insert($provider);

        foreach ([chat_completion::class, create_embedding::class] as $interface) {
            $default = $this->factory->ai()->default_provider()->entity()
                ->set_action_interface($interface)
                ->set_provider_id($this->provider_id);
            $this->default_ids[] = $this->factory->ai()->default_provider()->repository()->insert($default);
        }
    }

    protected function tearDown(): void
    {
        $_GET = $this->original_get;
        $_POST = $this->original_post;
        parent::tearDown();
    }

    private function request(bool $post, ?string $token = null, int $confirmed = 1): void
    {
        $params = ['id' => $this->provider_id, 'confirmed' => $confirmed];
        if ($token !== null) {
            $params['sesskey'] = $token;
        }
        $_GET = $post ? [] : $params;
        $_POST = $post ? $params : [];
    }

    private function assert_provider_and_defaults_exist(): void
    {
        $this->assertSame(
            $this->provider_id,
            $this->factory->ai()->provider()->repository()->get_by_id($this->provider_id)->get_id()
        );
        foreach ($this->default_ids as $id) {
            $this->assertSame(
                $this->provider_id,
                $this->factory->ai()->default_provider()->repository()->get_by_id($id)->get_provider_id()
            );
        }
    }

    public static function anonymous_requests(): array
    {
        return ['GET' => [false], 'POST' => [true]];
    }

    #[DataProvider('anonymous_requests')]
    public function test_anonymous_request_cannot_delete(bool $post): void
    {
        $this->request($post);

        try {
            (new manage_providers($this->factory))->action('delete');
            $this->fail('Anonymous requests must be redirected to login before deletion.');
        } catch (\moodle_exception $exception) {
            // Moodle redirects throw this exception under the CLI PHPUnit runner.
            $this->assertSame('redirecterrordetected', $exception->errorcode);
        }

        $this->assert_provider_and_defaults_exist();
    }

    public function test_user_without_configuration_permission_cannot_delete(): void
    {
        $this->setUser($this->getDataGenerator()->create_user());
        $this->request(true, sesskey());

        try {
            (new manage_providers($this->factory))->action('delete');
            $this->fail('Users without configuration permission must not delete providers.');
        } catch (\required_capability_exception $exception) {
            $this->assertSame('nopermissions', $exception->errorcode);
        }

        $this->assert_provider_and_defaults_exist();
    }

    public static function invalid_tokens(): array
    {
        return [
            'missing' => [null, 'missingparam'],
            'incorrect' => ['incorrect-token', 'invalidsesskey'],
            'empty' => ['', 'invalidsesskey'],
        ];
    }

    #[DataProvider('invalid_tokens')]
    public function test_authorised_post_without_valid_token_cannot_delete(?string $token, string $error): void
    {
        $this->setAdminUser();
        $this->request(true, $token);

        try {
            (new manage_providers($this->factory))->action('delete');
            $this->fail('A valid session token is required before deletion.');
        } catch (\moodle_exception $exception) {
            $this->assertSame($error, $exception->errorcode);
        }

        $this->assert_provider_and_defaults_exist();
    }

    public static function confirmation_requests(): array
    {
        return [
            'GET without token' => [false, false, 1],
            'GET with token' => [false, true, 1],
            'initial confirmation page' => [false, false, 0],
            'unconfirmed POST' => [true, true, 0],
        ];
    }

    #[DataProvider('confirmation_requests')]
    public function test_confirmation_requests_do_not_delete(bool $post, bool $with_token, int $confirmed): void
    {
        $this->setAdminUser();
        $this->request($post, $with_token ? sesskey() : null, $confirmed);
        $renderer = $this->createMock(\core_renderer::class);
        $renderer->expects($this->once())->method('header')->willReturn('header');
        $renderer->expects($this->once())->method('footer')->willReturn('footer');
        $renderer->expects($this->once())->method('render')->with(
            $this->isInstanceOf(\local_mxaimanager\output\manage_providers\delete::class)
        )->willReturn('confirmation');
        $factory = $this->getMockBuilder(base_factory::class)->onlyMethods(['output'])->getMock();
        $factory->method('output')->willReturn($renderer);

        $this->assertSame('headerconfirmationfooter', (new manage_providers($factory))->action('delete'));
        $this->assert_provider_and_defaults_exist();
    }

    public function test_authorised_post_with_valid_token_deletes_provider_and_its_defaults_only(): void
    {
        global $DB;

        $this->setAdminUser();
        $other = $this->factory->ai()->provider()->entity()
            ->set_name('Unaffected provider')
            ->set_classname(nebius::class)
            ->set_timecreated(time())
            ->set_timemodified(time());
        $other_id = $this->factory->ai()->provider()->repository()->insert($other);
        $other_default = $this->factory->ai()->default_provider()->entity()
            ->set_action_interface('other_action')
            ->set_provider_id($other_id);
        $other_default_id = $this->factory->ai()->default_provider()->repository()->insert($other_default);
        $this->request(true, sesskey());

        try {
            (new manage_providers($this->factory))->action('delete');
            $this->fail('Successful deletion must redirect to the provider list.');
        } catch (\moodle_exception $exception) {
            $this->assertSame('redirecterrordetected', $exception->errorcode);
        }

        $this->assertFalse($DB->record_exists('local_mxaimanager_providers', ['id' => $this->provider_id]));
        foreach ($this->default_ids as $id) {
            $this->assertFalse($DB->record_exists('local_mxaimanager_default_providers', ['id' => $id]));
        }
        $this->assertSame($other_id, $this->factory->ai()->provider()->repository()->get_by_id($other_id)->get_id());
        $this->assertSame(
            $other_id,
            $this->factory->ai()->default_provider()->repository()->get_by_id($other_default_id)->get_provider_id()
        );
    }

    public function test_preconfigured_provider_cannot_be_deleted_even_with_valid_post(): void
    {
        global $CFG;

        $this->setAdminUser();
        $CFG->local_mxaimanager_preconfigured_providers = [
            ['name' => 'Preconfigured Nebius', 'classname' => nebius::class],
        ];
        $this->request(true, sesskey());
        $_POST['id'] = -1;

        try {
            (new manage_providers($this->factory))->action('delete');
            $this->fail('Preconfigured providers must remain read-only.');
        } catch (\coding_exception $exception) {
            $this->assertStringContainsString('Cannot delete preconfigured providers.', $exception->getMessage());
        }

        $this->assertTrue($this->factory->ai()->provider()->repository()->get_by_id(-1)->get_is_preconfigured());
        $this->assert_provider_and_defaults_exist();
    }
}
