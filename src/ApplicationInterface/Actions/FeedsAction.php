<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\ApplicationInterface\RequestInterface;
use RSSReader\ApplicationInterface\Response;
use RSSReader\ApplicationInterface\ResponseInterface;
use RSSReader\Domain\Services\FeedService;

/**
 * Feeds Action
 */
final class FeedsAction
{
    /** @var FeedService */
    private $feedService;

    public function __construct()
    {
        $this->feedService = new FeedService();
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function get(RequestInterface $request) :ResponseInterface
    {
        $feeds = $this->feedService->findAllFeeds();

        return new Response(
            $feeds
        );
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function post(RequestInterface $request) :ResponseInterface
    {
        var_dump($request->getPostVars()); die;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function put(RequestInterface $request) :ResponseInterface
    {
        var_dump($request->getPutVars()); die;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function delete(RequestInterface $request) :ResponseInterface
    {
        var_dump('delete'); die;
    }
}