<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\Application\Helpers\Assert;
use RSSReader\ApplicationInterface\Exceptions\ValidationException;
use RSSReader\ApplicationInterface\RequestInterface;
use RSSReader\ApplicationInterface\Response;
use RSSReader\ApplicationInterface\ResponseInterface;
use RSSReader\Domain\Services\FeedService;

/**
 * Feed Action
 */
final class FeedAction
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
     * @throws ValidationException
     *
     * @return ResponseInterface
     */
    public function get(RequestInterface $request) :ResponseInterface
    {
        try {
            $queryVars = $request->getUriQueryVars();

            $feed = [];
            if (empty($queryVars) === false) {
                Assert::payload($queryVars, [
                    'id' => 'required',
                ]);

                $feed = $this->feedService->findFeedByID(
                    (int) $queryVars['id']
                );
            }

            return new Response(
                $feed
            );
        } catch(ValidationException $e) {
            return new Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    /**
     * @param RequestInterface $request
     *
     * @throws ValidationException
     *
     * @return ResponseInterface
     */
    public function put(RequestInterface $request) :ResponseInterface
    {
        try {
            $putVars = $request->getPutVars();
            $queryVars = $request->getUriQueryVars();

            if (empty($putVars) === false && empty($queryVars) === false) {
                Assert::payload($queryVars, [
                    'id' => 'required',
                ]);

                Assert::payload($putVars, [
                    'name' => 'required',
                    'url'  => 'required|url',
                ]);

                $this->feedService->updateFeed(
                    $putVars['name'],
                    $putVars['url'],
                    (int) $queryVars['id']
                );
            }

            return new Response(
                ['message' => 'Record Updated']
            );
        } catch(ValidationException $e) {
            return new Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    /**
     * @param RequestInterface $request
     *
     * @throws ValidationException
     *
     * @return ResponseInterface
     */
    public function delete(RequestInterface $request) :ResponseInterface
    {
        try {
            $queryVars = $request->getUriQueryVars();

            if (empty($queryVars) === false) {
                Assert::payload($queryVars, [
                    'id' => 'required',
                ]);

                $this->feedService->softDeleteFeed(
                    (int) $queryVars['id']
                );
            }

            return new Response(
                ['message' => 'Record Soft Deleted']
            );
        } catch(ValidationException $e) {
            return new Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}