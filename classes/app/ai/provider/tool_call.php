<?php

namespace local_mxaimanager\app\ai\provider;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * One function call requested by the model.
 */
class tool_call implements \JsonSerializable
{
    protected string $id;
    protected string $name;
    protected array $arguments;
    protected string $raw_arguments;

    public function __construct(string $id, string $name, array $arguments, string $raw_arguments)
    {
        $this->id = $id;
        $this->name = $name;
        $this->arguments = $arguments;
        $this->raw_arguments = $raw_arguments;
    }

    public function get_id(): string
    {
        return $this->id;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * @return array Decoded arguments ([] if the model sent invalid JSON).
     */
    public function get_arguments(): array
    {
        return $this->arguments;
    }

    public function get_raw_arguments(): string
    {
        return $this->raw_arguments;
    }

    /**
     * Serialised as the provider expects it inside an assistant message.
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'type' => 'function',
            'function' => [
                'name' => $this->name,
                'arguments' => $this->raw_arguments,
            ],
        ];
    }
}
