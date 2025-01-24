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

    public function handle($request){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $csrfToken = $request["csrf_token"] ?? null;

            if(!$csrfToken || !$this->security->verifyCsrfToken($csrfToken)){
                http_response_code(403);
                $this->router->handleError(403);
                $this->controller->setFlash("error","Forbidden: Invalid CSRF Token.");
            }
        }
        return true;
    }
}