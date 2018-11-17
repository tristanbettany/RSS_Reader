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
     * @return array
     */
    public function findAllFeeds() :array
    {
        $query = "
            SELECT 
                feeds.id        AS id,
                feeds.name      AS name,
                feeds.url       AS url,
                feeds.is_active AS is_active,
                date_added      AS date_added
            FROM ". self::TABLE_NAME ." AS feeds
        ";

        $results = $this->fetchAll($query);

        return $results;
    }
}