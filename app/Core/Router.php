<?php

namespace Core;

class Router {
    protected $routes = [];

    public function get($uri, $controller) {
        $this->routes["GET"][$uri] = $controller;
    }
}