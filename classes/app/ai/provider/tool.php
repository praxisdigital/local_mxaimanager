<?php

namespace local_mxaimanager\app\ai\provider;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * A function the model may call, described by a JSON schema (OpenAI-compatible "tools" entry).
 */
class tool implements \JsonSerializable
{
    protected string $name;
    protected string $description;
    protected array $parameters;

    /**
     * @param string $name Function name, [a-zA-Z0-9_-] only.
     * @param string $description What the tool does and when to use it.
     * @param array $parameters JSON schema of the arguments object.
     */
    public function __construct(string $name, string $description, array $parameters)
    {
        $this->name = $name;
        $this->description = $description;
        $this->parameters = $parameters;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function get_description(): string
    {
        return $this->description;
    }

    public function get_parameters(): array
    {
        return $this->parameters;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'function',
            'function' => [
                'name' => $this->name,
                'description' => $this->description,
                'parameters' => $this->parameters,
            ],
        ];
    }
}
