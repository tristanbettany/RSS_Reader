<?php

return [
    'routes' => require_once __DIR__ . '/routes.php',
    'commands' => [
        \RSSReader\Application\Commands\MigrateCommand::class,
        \RSSReader\Application\Commands\SeedCommand::class
    ],
    'migrations' => [
        \RSSReader\Database\Migrations\FeedsTable::class
    ],
    'seeds' => [
        \RSSReader\Database\Seeds\FeedsSeed::class
    ]
];