<?php

namespace RSSReader\Domain\Services;

use RSSReader\Database\Gateways\FeedGateway;

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
     * Find all the feeds
     *
     * @return array
     */
    public function findAllFeeds() :array
    {
        return $this->feedGateway->findAllFeeds();
    }
}