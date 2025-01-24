<?php

use Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App();

require_once __DIR__ . '/../config/routes.php';

$app->run();