<?php

    namespace Controllers; // Debe tener todos los conterollers del composer json

    use MVC\Router;

    class LoginController {
        public static function login () {
            echo json_encode("Desde login");
        }
    }