<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */

    namespace Connection;

    return [
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'database' => $_ENV['DB_DATABASE'] ?? 'academix_db',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'base_url' => $_ENV['APP_URL'] ?? '',
        'charset' => 'utf8mb4',
        'script_path' => __DIR__ . '/../Public/assets/data/script.sql',
    ];
