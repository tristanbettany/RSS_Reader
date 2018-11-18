<?php

namespace RSSReader\Domain\Services;

use RSSReader\Database\Gateways\FeedGateway;
use RSSReader\Domain\Factories\RSS;

/**
 * Feed Service class
 */
final class FeedService
{
    /** @var FeedGateway */
    private $feedGateway;

    /**
     * FeedService constructor.
     */
    public function __construct()
    {
        $this->feedGateway = new FeedGateway();
    }

    /**
     * Find feed by ID
     *
     * @param int $feedID
     *
     * @return array
     */
    public function findFeedByID(int $feedID) :array
    {
        return $this->feedGateway->findFeedByID($feedID);
    }

    /**
     * Find all the feeds
     *
     * @return array
     */
    public function findAllFeeds() :array
    {
        return $this->feedGateway->findAllFeeds();
    }

    /**
     * Create a feed record in the db
     *
     * @param string $feedName
     * @param string $feedUrl
     *
     * @return void
     */
    public function addFeed(
        string $feedName,
        string $feedUrl
    ) {
        $this->feedGateway->addFeed(
            $feedName,
            $feedUrl
        );
    }

    /**
     * Update a feed record in the db
     *
     * @param string $feedName
     * @param string $feedUrl
     * @param int    $feedID
     *
     * @return void
     */
    public function updateFeed(
        string $feedName,
        string $feedUrl,
        int    $feedID
    ) {
        $this->feedGateway->updateFeed(
            $feedName,
            $feedUrl,
            $feedID
        );
    }

    /**
     * Soft Delete a feed
     *
     * @param int $feedID
     *
     * @return void
     */
    public function softDeleteFeed(int $feedID)
    {
        $this->feedGateway->softDeleteFeed($feedID);
    }

    /**
     * Get the content of a feed
     *
     * @param int $feedID
     *
     * @return array
     */
    public function getFeedContent(int $feedID) :array
    {
        $feed = $this->findFeedByID($feedID);

        return RSS::forge($feed['url'])->parseFeed();
    }
}