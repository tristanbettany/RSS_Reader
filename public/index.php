<?php

require __DIR__ . '/../vendor/autoload.php';

use RSSReader\Application\App;
use RSSReader\ApplicationInterface\Exceptions\HttpNotFoundException;
use RSSReader\Application\Helpers\Env;
use RSSReader\Database\Connection;

try {
    //Env
    $envVars = require_once __DIR__ . '/../env.php';
    $env = new Env($envVars);

    //Config
    $config = require_once __DIR__ . '/../src/Application/Config/app.php';

    //DB Connection
    new Connection();

    //Boot App
    $app = new App($config);
} catch (
    HttpNotFoundException |
    PDOException
    $e
) {
    echo $e->getMessage();
}