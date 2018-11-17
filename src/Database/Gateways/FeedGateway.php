<?php

namespace RSSReader\Database\Gateways;

use RSSReader\Database\Gateway;

/**
 * Feed Gateway class
 */
final class FeedGateway extends Gateway
{
    const TABLE_NAME = 'rss_feeds';

    /**
     * Find all the feeds in the table
     *
     * @param int $feedID
     *
     * @return array
     */
    public function findFeedByID(int $feedID) :array
    {
        $query = "
            SELECT 
                id,
                name,
                url,
                is_active,
                date_added
            FROM ". self::TABLE_NAME ."
            WHERE is_active = 1
            AND id = :feed_id
        ";

        $result = $this->fetch(
            $query,
            [
                'feed_id' => $feedID,
            ]
        );

        if (empty($result) === true) {
            return [];
        }

        return $result;
    }

    /**
     * Find all the feeds in the table
     *
     * @return array
     */
    public function findAllFeeds() :array
    {
        $query = "
            SELECT 
                id,
                name,
                url,
                is_active,
                date_added
            FROM ". self::TABLE_NAME ."
            WHERE is_active = 1
            ORDER BY date_added DESC
        ";

        $results = $this->fetchAll($query);

        if (empty($results) === true) {
            return [];
        }

        return $results;
    }

    /**
     * Create a feed record in the db
     *
     * @param string $feedName
     * @param string $feedUrl
     */
    public function addFeed(
        string $feedName,
        string $feedUrl
    ) {
        $query = "
            INSERT INTO ". self::TABLE_NAME ."
            (
                name,
                url,
                is_active,
                date_added
            )
            VALUES
            (
                :feed_name,
                :feed_url,
                1,
                NOW()
            )
        ";

        $this->execute(
            $query,
            [
                'feed_name' => $feedName,
                'feed_url'  => $feedUrl,
            ]
        );
    }

    /**
     * Create a feed record in the db
     *
     * @param string $feedName
     * @param string $feedUrl
     * @param int    $feedID
     */
    public function updateFeed(
        string $feedName,
        string $feedUrl,
        int    $feedID
    ) {
        $query = "
            UPDATE ". self::TABLE_NAME ."
            SET
                name = :feed_name,
                url = :feed_url,
                is_active = 1
            WHERE
                id = :feed_id
        ";

        $this->execute(
            $query,
            [
                'feed_name' => $feedName,
                'feed_url'  => $feedUrl,
                'feed_id'   => $feedID,
            ]
        );
    }

    /**
     * Create a feed record in the db
     *
     * @param int $feedID
     */
    public function softDeleteFeed(
        int $feedID
    ) {
        $query = "
            UPDATE ". self::TABLE_NAME ."
            SET
                is_active = 0
            WHERE
                id = :feed_id
        ";

        $this->execute(
            $query,
            [
                'feed_id' => $feedID,
            ]
        );
    }
}