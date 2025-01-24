<?php

namespace Middleware;

use Core\Controller;
use Core\Router;
use Core\Security;

class CsrfMiddleware {
    private $security;
    private $router;
    private $controller;

    public function __construct(){
        $this->security = new Security();
        $this->router = new Router();
        $this->controller = new Controller();
    }
}