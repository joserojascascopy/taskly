<?php

namespace Controllers;

use Models\User;
use MVC\Router;

class PerfilController {
    public static function index(Router $router) {
        session_start();
        $user = new User; // Instanciamos la clase User
        $alertas = User::getAlertas();

        $update = $_GET['update'] ?? null;

        if ($update) {
            $alertas['exito'] = 'Se ha actualizado su perfil';
        }

        $user_id = $_SESSION['id'];

        $user = $user->getUserById($user_id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['nombre'] === '') {
                $alertas['error'] = 'Los campos no pueden estar vacios';
            }else {
                $partes = explode(' ', $_POST['nombre']);
                $nombre = $partes[0];
                $apellido = $partes[1];

                if($nombre !== $user->nombre || $apellido !== $user->apellido) {
                    $resultado = $user->updateUser($user_id, $nombre, $apellido);

                    if ($resultado) {
                        header('Location: /perfil?update=1');
                    }
                }
            }
        }

        $router->render('dashboard/perfil', [
            'user_id' => $user_id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'email' => $user->email,
            'alertas' => $alertas
        ]);
    }
}
