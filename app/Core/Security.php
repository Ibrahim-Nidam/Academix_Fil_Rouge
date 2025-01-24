<?php

namespace Core;


class Security {

    private $passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    private $csrfTokenKey = "csrf_token";

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function validePassword($password){
        if(preg_match($this->passwordPattern, $password)){
            return true;
        }
        return false;
    }

    public function generateCsrfToken(){
        $token = bin2hex(random_bytes(32));
        $_SESSION[$this->csrfTokenKey] = $token;
        $_SESSION["csrf_token_time"] = time();
        return $token;
    }

    public function verifyCsrfToken($token){
        $tokenLifeTime = 600;

        if(isset($_SESSION[$this->csrfTokenKey], $_SESSION["csrf_token_time"]) 
            && hash_equals($_SESSION[$this->csrfTokenKey], $token)){
            
            if(time() - $_SESSION["csrf_token_time"] > $tokenLifeTime){
                unset($_SESSION[$this->csrfTokenKey], $_SESSION["csrf_token_time"]);
                die("CSRF token expired. Please refresh the form.");
            }

            unset($_SESSION[$this->csrfTokenKey], $_SESSION["csrf_token_time"]);
            return true;
        }
        return false;
    }
}