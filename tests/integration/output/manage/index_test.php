<?php

namespace local_mxaimanager\integration\output\manage;

defined('MOODLE_INTERNAL') || die();

use local_mxaimanager\app\factory;
use local_mxaimanager\output\manage\index;

/** Regression coverage for the management page without configured providers. */
class index_test extends \advanced_testcase
{
    public function test_management_output_renders_without_providers(): void
    {
        global $PAGE, $CFG;
        $this->resetAfterTest();
        $this->setAdminUser();
        unset($CFG->local_mxaimanager_preconfigured_providers);
        $PAGE->set_context(\core\context\system::instance());
        $PAGE->set_url('/local/mxaimanager/view.php', ['view' => 'manage', 'action' => 'index']);
        $renderer = $PAGE->get_renderer('core');
        $output = new index(factory::make());
        $context = $output->export_for_template($renderer);
        $this->assertTrue($context['general']);
        $this->assertTrue($context['no_providers']);
        $this->assertTrue($context['no_default_providers']);
        $this->assertNotEmpty($renderer->render($output));
    }
}
