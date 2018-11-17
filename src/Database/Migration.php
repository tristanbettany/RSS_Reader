<?php

namespace RSSReader\Database;

use PDO;

/**
 * Migration class
 */
class Migration
{
    /** @var PDO */
    protected $connection;

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }
}