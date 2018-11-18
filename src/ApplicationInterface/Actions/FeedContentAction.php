<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\Application\Helpers\Assert;
use RSSReader\ApplicationInterface\Exceptions\ValidationException;
use RSSReader\ApplicationInterface\RequestInterface;
use RSSReader\ApplicationInterface\Response;
use RSSReader\ApplicationInterface\ResponseInterface;
use RSSReader\Domain\Services\FeedService;

/**
 * Feed Content Action
 */
final class FeedContentAction
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

            $feedContent = [];
            if (empty($queryVars) === false) {
                Assert::payload($queryVars, [
                    'id' => 'required',
                ]);

                $feedContent = $this->feedService->getFeedContent(
                    (int) $queryVars['id']
                );
            }

            return new Response(
                $feedContent
            );
        } catch(ValidationException $e) {
            return new Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}