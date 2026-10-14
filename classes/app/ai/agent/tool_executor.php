<?php

namespace local_mxaimanager\app\ai\agent;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

use local_mxaimanager\app\ai\provider\tool;

/**
 * A tool the agent can run: its definition for the model, and the code that executes it.
 */
interface tool_executor
{
    public function definition(): tool;

    /**
     * @param array $arguments Decoded arguments from the model.
     */
    public function execute(array $arguments): tool_result;
}
