<?php

namespace RSSReader\ApplicationInterface;

/**
 * Exception Hangler Class
 */
final class ExceptionHandler
{
    /**
     * Error handler
     *
     * @param $errSeverity
     * @param $errMessage
     * @param $errFile
     * @param $errLine
     * @param array $errContext
     *
     * @throws \ErrorException
     *
     * @return bool
     */
    public static function handle(
              $errSeverity,
              $errMessage,
              $errFile,
              $errLine,
        array $errContext
    ) {
        if (error_reporting() === 0) {
            return false;
        }

        throw new \ErrorException($errMessage, 0, $errSeverity, $errFile, $errLine);
    }
}