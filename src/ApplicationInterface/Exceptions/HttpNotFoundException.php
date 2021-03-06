<?php

namespace RSSReader\ApplicationInterface\Exceptions;

/**
 * 404 Not found exception
 */
final class HttpNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('404 Not Found', 404);
    }
}