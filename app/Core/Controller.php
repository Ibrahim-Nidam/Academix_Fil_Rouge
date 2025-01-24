<?php

namespace Core;


class Controller {
    protected $security;
    protected $router;

    public function __construct(){
        $this->security = new Security;
        $this->router = new Router();
    }

    protected function showView($view, $data = []){
        extract($data);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $flashMessages = [];
        if (isset($_SESSION['flash'])) {
            $flashMessages = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $viewPath = __DIR__ . "/../../app/Views/{$view}.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View '{$view}' not found");
        }
    }

    protected function redirect($url){
        header("Location: {$url}");
        exit();
    }

    
}