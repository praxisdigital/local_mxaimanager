<?php

namespace local_mxaimanager\app\ai;


// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

class factory
{
    protected \local_mxaimanager\app\factory $base_factory;

    public function __construct(\local_mxaimanager\app\factory $base_factory)
    {
        $this->base_factory = $base_factory;
    }

    public function provider(): provider\factory
    {
        return new provider\factory($this->base_factory);
    }

    public function default_provider(): default_provider\factory
    {
        return new default_provider\factory($this->base_factory);
    }

    public function feature(): feature\factory
    {
        return new feature\factory($this->base_factory);
    }

    /**
     * @param callable $complete fn(array $messages, array $tools): \local_mxaimanager\app\ai\provider\tool_completion_request
     */
    public function agent(callable $complete, int $max_steps = agent\agent::DEFAULT_MAX_STEPS): agent\agent
    {
        return new agent\agent($complete, $max_steps);
    }
}
