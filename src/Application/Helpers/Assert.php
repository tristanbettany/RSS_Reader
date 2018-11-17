<?php

namespace RSSReader\Application\Helpers;

use RSSReader\ApplicationInterface\Exceptions\ValidationException;

/**
 * Assert class
 */
final class Assert
{
    /**
     * @param array $payload
     * @param array $params
     *
     * @throws ValidationException
     */
    public static function payload(array $payload, array $params)
    {
        foreach ($params as $param => $funcString) {
            $funcs = explode('|', $funcString);
            foreach($funcs as $func) {
                if (empty($payload[$param]) === true) {
                    $val = null;
                } else {
                    $val = $payload[$param];
                }
                self::$func($val, $param);
            }
        }
    }

    /**
     * @param      $val
     * @param null $param
     *
     * @throws ValidationException
     */
    private static function required($val, $param = null)
    {
        if (empty($val) === true) {
            throw new ValidationException('"' . $param . '" is required');
        }
    }

    /**
     * @param      $val
     * @param null $param
     *
     * @throws ValidationException
     */
    private static function email($val, $param = null)
    {
        if (filter_var($val, FILTER_VALIDATE_EMAIL) === false) {
            throw new ValidationException('"' . $val . '" does not meet the requirements for an email address');
        }
    }
}