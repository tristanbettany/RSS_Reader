<?php

return [
    'home' => [
        'methods' => ['GET'],
        'path'    => '/',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\HomeAction',
    ],
    'feeds' => [
        'methods' => ['GET', 'POST'],
        'path'    => '/feeds',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\FeedsAction',
    ],
    'feed' => [
        'methods' => ['GET', 'PUT', 'DELETE'],
        'path'    => '/feed',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\FeedAction',
    ],
    'feed_content' => [
        'methods' => ['GET'],
        'path'    => '/feed/content',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\FeedContentAction',
    ],
];