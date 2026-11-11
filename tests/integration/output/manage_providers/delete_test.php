<?php

namespace local_mxaimanager\integration\output\manage_providers;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\ai\provider\providers\nebius;
use local_mxaimanager\app\factory as base_factory;
use local_mxaimanager\output\manage_providers\delete;

class delete_test extends \advanced_testcase
{
    public function test_confirmation_form_posts_with_session_token(): void
    {
        global $PAGE;

        $this->resetAfterTest();
        $this->setAdminUser();
        $PAGE->set_context(\core\context\system::instance());
        $PAGE->set_url('/local/mxaimanager/view.php', ['view' => 'manage_providers', 'action' => 'delete']);
        $factory = new base_factory();
        $provider = $factory->ai()->provider()->entity()
            ->set_name('Provider <name>')
            ->set_classname(nebius::class)
            ->set_timecreated(time())
            ->set_timemodified(time());
        $id = $factory->ai()->provider()->repository()->insert($provider);
        $output = new delete($factory, $id);
        $renderer = $PAGE->get_renderer('core');
        $data = $output->export_for_template($renderer);

        $this->assertSame($id, $data['id']);
        $this->assertSame(sesskey(), $data['sesskey']);
        $this->assertSame('Provider <name>', $data['name']);
        $this->assertTrue($data['providers']);
        $this->assertSame('local_mxaimanager/manage_providers/delete', $output->get_template_name($renderer));

        $document = new \DOMDocument();
        @$document->loadHTML($renderer->render($output));
        $xpath = new \DOMXPath($document);
        $forms = $xpath->query('//form');
        $this->assertCount(1, $forms);
        $form = $forms->item(0);
        $this->assertSame('post', $form->getAttribute('method'));
        $this->assertSame($data['delete_url'], $form->getAttribute('action'));
        foreach (['id' => (string) $id, 'confirmed' => '1', 'sesskey' => sesskey()] as $name => $value) {
            $inputs = $xpath->query('.//input[@type="hidden"][@name="' . $name . '"]', $form);
            $this->assertCount(1, $inputs);
            $this->assertSame($value, $inputs->item(0)->getAttribute('value'));
        }
        $this->assertCount(1, $xpath->query('.//button[@type="submit"]', $form));
        $this->assertCount(0, $xpath->query('//a[contains(@href,"confirmed=1")]'));
        $this->assertCount(1, $xpath->query('//a[@href="' . $data['cancel_url'] . '"]'));
        $this->assertStringContainsString('Provider &lt;name&gt;', $renderer->render($output));
    }
}
