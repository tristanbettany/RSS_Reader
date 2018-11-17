<?php

namespace RSSReader\ApplicationInterface\Exceptions;

/**
 * Validation exception
 */
final class ValidationException extends \Exception
{
    /**
     * ValidationException constructor.
     *
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        if ($message === null) {
            parent::__construct('Validation Error', 400);
        } else {
            parent::__construct($message, 400);
        }
    }
}