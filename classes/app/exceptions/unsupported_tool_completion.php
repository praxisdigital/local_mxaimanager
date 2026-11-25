<?php

namespace local_mxaimanager\app\exceptions;

defined('MOODLE_INTERNAL') || die();

/** The provider explicitly rejected tool support for this request. */
class unsupported_tool_completion extends invalid_provider_instance_response
{
}
