<?php

namespace Middleware;

use Core\ErrorHandler;
use Core\Middleware;

class AuthMiddleware extends Middleware {
    public function handle() {
        session_start();

        if (!isset($_SESSION['user'])) {
            ErrorHandler::handle(403, 'User not authenticated');
        }
    }
}
