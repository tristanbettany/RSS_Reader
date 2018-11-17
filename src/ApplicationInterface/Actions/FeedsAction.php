<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\Application\Helpers\Assert;
use RSSReader\ApplicationInterface\Exceptions\ValidationException;
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
     * @throws ValidationException
     *
     * @return ResponseInterface
     */
    public function post(RequestInterface $request) :ResponseInterface
    {
        $postVars = $request->getPostVars();

        if (empty($postVars) === false) {
            Assert::payload($postVars, [
                'name' => 'required',
                'url'  => 'required',
            ]);

            $this->feedService->addFeed(
                $postVars['name'],
                $postVars['url']
            );
        }

        return new Response(
            ['message' => 'Record Added']
        );
    }
}