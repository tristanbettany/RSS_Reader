<?php

return [
    'home' => [
        'methods' => ['GET'],
        'path'    => '/',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\HomeAction',
    ],
    'feeds' => [
        'methods' => ['GET', 'POST', 'PUT', 'DELETE'],
        'path'    => '/feeds',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\FeedsAction',
    ],
];