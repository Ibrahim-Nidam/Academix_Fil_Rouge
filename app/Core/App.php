<?php

    namespace Core;

    class App {
        public static $router;

        public function __construct(){
            self::$router = new Router();
        }

        public function run() {
            $uri = rawurldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
    
            $scriptName = dirname($_SERVER["SCRIPT_NAME"]);
            $basePath = rtrim($scriptName, '/');
    
            if (strpos($uri, $basePath) === 0) {
                $uri = substr($uri, strlen($basePath));
            }
    
            $uri = '/' . ltrim($uri, '/');
    
            $method = $_SERVER["REQUEST_METHOD"];
    
            self::$router->route($uri, $method);
        }
    }