<?php

return [
    'routes' => require_once __DIR__ . '/routes.php',
    'commands' => [
        \RSSReader\Application\Commands\MigrateCommand::class
    ],
];