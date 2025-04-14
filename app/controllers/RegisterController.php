<?php

namespace Controllers;

use Models\User;
use MVC\Router;

class RegisterController {
    public static function register(Router $router) {
        $user = new User;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $resultado = $user->createUser($nombre, $apellido, $email, $password);
            debug($resultado);
        }

        $router->render('auth/register', [
        ]);
    }
}