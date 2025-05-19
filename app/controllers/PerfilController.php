<?php

namespace Controllers;

use Models\User;
use MVC\Router;

class PerfilController {
    public static function index(Router $router) {
        session_start();
        $user = new User; // Instanciamos la clase User
        $alertas = User::getAlertas();
        
        $user_id = $_SESSION['id'];

        $user = $user->getUserById($user_id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partes = explode(' ', $_POST['nombre']);
            $nombre = $partes[0];
            $apellido = $partes[1];
            $email = $_POST['email'];

            if($_POST['nombre'] === '' || $_POST['email'] === '') {
                $alertas['error'] = 'Debes completar todos los campos';
            }
        }

        $router->render('dashboard/perfil', [
            'user_id' => $user_id,
            'nombre' => $user['nombre'],
            'apellido' => $user['apellido'],
            'email' => $user['email'],
            'alertas' => $alertas
        ]);
    }
}