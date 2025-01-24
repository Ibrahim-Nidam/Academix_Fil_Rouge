<?php

    namespace Core;

    class Router {
        protected $routes = [];

        public function get($uri, $controller) {
            $this->routes["GET"][$uri] = $controller;
        }

        public function post($uri, $controller){
            $this->routes["POST"][$uri] = $controller;
        }

        public function route($uri, $method) {
            $routes = $this->routes[$method] ?? [];
        
            foreach ($routes as $route => $controller) {
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([0-9]+)', $route);
                if (preg_match("#^$pattern$#", $uri, $matches)) {
                    array_shift($matches);
        
                    if (is_array($controller)) {
                        [$class, $method] = $controller;
        
                        if (!class_exists($class)) {
                            die("Class not found: $class");
                        }
        
                        $controller = new $class();
                        return call_user_func_array([$controller, $method], $matches);
                    }
                }
            }
        
            $this->handleError(404);
        }
        

        public function handleError($code){

            http_response_code($code);

            switch($code){
                case 404:
                    require_once __DIR__ . "/../Views/errors/404.php";
                break;
                case 403 : 
                    require_once __DIR__ . "/../Views/errors/403.php";
                break;
                default : 
                // echo "{$code}";
            }

            exit();
        }
    }