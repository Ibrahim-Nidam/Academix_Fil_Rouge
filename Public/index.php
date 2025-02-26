<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */

use Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new App();

require_once __DIR__ . '/../config/routes.php';

$app->run();