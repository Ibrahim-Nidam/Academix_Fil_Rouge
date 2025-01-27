<?php

namespace Middleware;

use Core\ErrorHandler;
use Core\Middleware;

class RoleMiddleware extends Middleware {
    protected $requiredRole;

    public function __construct($requiredRole = null) {
        $this->requiredRole = $requiredRole;
    }

    public function handle() {
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['user'])) {
            ErrorHandler::handle(403, 'User not authenticated');
        }

        // Check if the user has the required role
        if ($this->requiredRole && $_SESSION['user']['role'] !== $this->requiredRole) {
            ErrorHandler::handle(403, 'User does not have the required role');
        }

        // Additional checks (e.g., account status)
        if (isset($_SESSION['user']['status']) && $_SESSION['user']['status'] !== 'active') {
            ErrorHandler::handle(403, 'User account is not active');
        }
    }
}
