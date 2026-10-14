<?php

namespace local_mxaimanager\app\ai\agent;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();

// @codeCoverageIgnoreEnd

/**
 * What a tool returns. needs_followup decides whether the model must see the result:
 * a successful edit does not (the loop can stop), a view or an error does (it continues).
 */
class tool_result
{
    protected string $content;
    protected bool $ok;
    protected bool $needs_followup;

    public function __construct(string $content, bool $ok, bool $needs_followup)
    {
        $this->content = $content;
        $this->ok = $ok;
        $this->needs_followup = $needs_followup;
    }

    /**
     * The action worked and the model does not need to read the result.
     */
    public static function done(string $content = 'OK'): self
    {
        return new self($content, true, false);
    }

    /**
     * The action worked and returned information the model asked for.
     */
    public static function info(string $content): self
    {
        return new self($content, true, true);
    }

    /**
     * The action failed; the model is told why and gets another turn.
     */
    public static function error(string $content): self
    {
        return new self($content, false, true);
    }

    public function get_content(): string
    {
        return $this->content;
    }

    public function is_ok(): bool
    {
        return $this->ok;
    }

    public function needs_followup(): bool
    {
        return $this->needs_followup;
    }
}
