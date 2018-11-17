<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\ApplicationInterface\RequestInterface;

/**
 * Home Action
 */
final class HomeAction
{
    /**
     * @param RequestInterface $request
     */
    public function get(RequestInterface $request)
    {
        die('homeaction');
    }
}