<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */

namespace Core;

class Router {
    protected $routes = [];

    public function get($uri, $controller, $middleware = null) {
        $this->routes["GET"][$uri] = ['controller' => $controller, 'middleware' => $middleware];
    }

    public function post($uri, $controller, $middleware = null) {
        $this->routes["POST"][$uri] = ['controller' => $controller, 'middleware' => $middleware];
    }

    public function route($uri, $method) {
        $routes = $this->routes[$method] ?? [];
    
        foreach ($routes as $route => $options) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([0-9]+)', $route);
    
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
    
                $middleware = $options['middleware'];
                if ($middleware) {
                    if (is_callable($middleware)) {
                        $middleware = $middleware();
                    }
                    if ($middleware instanceof Middleware) {
                        $middleware->handle();
                    }
                }
    
                $controller = $options['controller'];
                if (is_array($controller)) {
                    [$class, $method] = $controller;
                    if (!class_exists($class)) {
                        ErrorHandler::handle(500, "Class not found: $class");
                    }
                    $controller = new $class();
                    return call_user_func_array([$controller, $method], $matches);
                }
            }
        }
    
        ErrorHandler::handle(404, "Route not found: $uri");
    }
    
}