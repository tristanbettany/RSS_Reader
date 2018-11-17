<?php

namespace RSSReader\Database;

use PDO;
use PDOStatement;

/**
 * Gateway class
 */
class Gateway
{
    /** @var PDO */
    private $connection;

    /**
     * Gateway constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /**
     * Fetch one row
     *
     * @param string $query
     * @param array $bindings
     *
     * @return mixed
     */
    public function fetch(
        string $query,
        array  $bindings = []
    ) {
        $preparedQuery = $this->prepareQuery(
            $query,
            $bindings
        );

        return $preparedQuery->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all rows
     *
     * @param string $query
     * @param array $bindings
     *
     * @return array
     */
    public function fetchAll(
        string $query,
        array  $bindings = []
    ) {
        $preparedQuery = $this->prepareQuery(
            $query,
            $bindings
        );

        return $preparedQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return void
     */
    public function execute(
        string $query,
        array  $bindings = []
    ) {
        $this->prepareQuery(
            $query,
            $bindings
        );
    }

    /**
     * Prepare the query
     *
     * @param string $query
     * @param array $bindings
     *
     * @return PDOStatement
     */
    private function prepareQuery(
        string $query,
        array  $bindings = []
    ) :PDOStatement {
        $preparedQuery = $this->connection->prepare($query);
        $preparedQuery->execute($bindings);

        return $preparedQuery;
    }
}