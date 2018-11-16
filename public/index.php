<?php

require __DIR__ . '/../vendor/autoload.php';

use RSSReader\Application\App;

$config = require_once __DIR__ . '/../src/Application/Config/app.php';
$app = new App($config);