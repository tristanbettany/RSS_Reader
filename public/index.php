<?php

require __DIR__ . '/../vendor/autoload.php';

use RSSReader\Application\App;
use RSSReader\ApplicationInterface\Exceptions\HttpNotFoundException;

try {
    $config = require_once __DIR__ . '/../src/Application/Config/app.php';
    $app = new App($config);
} catch (HttpNotFoundException $e) {
    echo $e->getMessage();
}