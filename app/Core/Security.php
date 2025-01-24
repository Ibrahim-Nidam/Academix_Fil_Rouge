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
}