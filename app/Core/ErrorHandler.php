<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */
namespace Core;

class ErrorHandler {
    private static $errorViewsPath = __DIR__ . '/../Views/errors/';
    private static $defaultErrorView = 'generic.php';

    public static function handle($code, $message = '') {
        http_response_code($code);

        $errorFile = self::$errorViewsPath . "{$code}.php";

        if (file_exists($errorFile)) {
            require_once $errorFile;
        } else {
            require_once self::$errorViewsPath . self::$defaultErrorView;
        }

        self::logError($code, $message);
        exit();
    }

    private static function logError($code, $message) {
        $logFile = __DIR__ . '/../storage/logs/error.log';
        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date] Error $code: $message\n";

        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
}
