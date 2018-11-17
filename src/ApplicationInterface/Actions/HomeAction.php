<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\ApplicationInterface\RequestInterface;
use RSSReader\Domain\Services\FeedService;

/**
 * Home Action
 */
final class HomeAction
{
    /** @var FeedService */
    private $feedService;

    public function __construct()
    {
        $this->feedService = new FeedService();
    }

    /**
     * @param RequestInterface $request
     */
    public function get(RequestInterface $request)
    {
        $feeds = $this->feedService->findAllFeeds();

        var_dump($feeds);
    }
}