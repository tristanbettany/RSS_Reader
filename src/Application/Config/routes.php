<?php

return [
    'home' => [
        'methods' => ['GET', 'POST'],
        'path'    => '/',
        'action'  => '\\RSSReader\\ApplicationInterface\\Actions\\HomeAction',
    ],
];