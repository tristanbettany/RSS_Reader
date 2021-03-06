<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\ApplicationInterface\RequestInterface;
use RSSReader\ApplicationInterface\Response;
use RSSReader\ApplicationInterface\ResponseInterface;

/**
 * Home Action
 */
final class HomeAction
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function get(RequestInterface $request) :ResponseInterface
    {
        return new Response(
            ['test' => 'im a test'],
            200,
            'index',
            'HTML'
        );
    }
}