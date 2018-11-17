<?php

namespace RSSReader\Database;

use PDO;

/**
 * Connection class
 */
final class Connection
{
    /** @var PDO */
    private static $connection;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $host         = getenv('DB_HOST');
        $port         = getenv('DB_PORT');
        $dbName       = getenv('DB_NAME');
        $userName     = getenv('DB_USER_NAME');
        $password     = getenv('DB_PASSWORD');

        $characterSet = empty(getenv('DB_CHARSET')) === false ? getenv('DB_CHARSET') : 'utf8';

        static::$connection = new PDO(
            'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbName . ';charset=' . $characterSet,
            $userName,
            $password,
            [
                PDO::ATTR_PERSISTENT => true
            ]
        );

        try {

        } catch(\Exception $e) {

        }

    }

    /**
     * Get the connection
     *
     * @return PDO
     */
    public static function getConnection() :PDO
    {
        return static::$connection;
    }
}