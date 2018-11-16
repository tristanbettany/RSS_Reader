<?php

namespace RSSReader\ApplicationInterface\Actions;

use RSSReader\ApplicationInterface\RequestInterface;

/**
 * Home Action
 */
final class HomeAction
{
    public function get(RequestInterface $request)
    {
        die('homeaction');
    }
}