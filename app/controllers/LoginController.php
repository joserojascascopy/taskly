<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Models\User;

use Dotenv\Dotenv;

define('API_KEY', $_ENV['API_KEY']);
define('PROJECT_ID', $_ENV['PROJECT_ID']);
define('STORAGE_BUCKET', $_ENV['STORAGE_BUCKET']);
define('MESSAGING_SENDER_ID', $_ENV['MESSAGING_SENDER_ID']);
define('APP_ID', $_ENV['APP_ID']);
define('AUTH_DOMAIN', $_ENV['AUTH_DOMAIN']);

if (!isset($_ENV['DB_HOST'])) {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
}
class LoginController {
    public static function login(Router $router) {
        $user = new User;
        $alertas = User::getAlertas();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            // Validamos el formulario
            $alertas = $user->validateLogin();

            if (empty($alertas)) {
                // Verificar si existe el usuario
                $isRegister = $user->getUserByEmail($user->email);

                if (empty($isRegister)) {
                    $alertas['error'] = 'Usuario no registrado';
                } else {
                    // Verificamos el password
                    $isCorrectPassword = password_verify($user->password, $isRegister->password);

                    if ($isCorrectPassword) {
                        session_start();

                        $_SESSION = [
                            'login' => true,
                            'id' => $isRegister->id,
                            'nombre' => $isRegister->nombre,
                        ];

                        header('Location: /dashboard');
                    } else {
                        $alertas['error'] = 'Contraseña Incorrecta';
                    }
                }
            }
        }

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function forgot(Router $router) {
        $user = new User;

        $alertas = User::getAlertas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);

            $alertas = $user->validarReset();

            if (empty($alertas)) {
                // Comprobar si el usuario esta registrado
                $userRegistered = $user->getUserByEmail($user->email);
                $userRegistered->generateToken();

                $email = new Email($userRegistered->nombre, $userRegistered->apellido, $userRegistered->email, $userRegistered->token);
                $sendEmail = $email->enviarRestablecer();

                if ($sendEmail) {
                    $userRegistered->updateToken($userRegistered->id, $userRegistered->token);
                    $alertas['exito'] = 'Correo enviado, revise su bandeja de entrada';
                }
            }
        }

        $router->render('auth/forgot', [
            'alertas' => $alertas
        ]);
    }

    public static function reset(Router $router) {
        // Instanciamos la clase User vacio para utilizar los metodos no estaticos
        $user = new User;
        // Obtenemos el array de $alertas (vacio)
        $alertas = User::getAlertas();
        $error = false;
        // Obtenemos el token del query string
        $token = $_GET['token'];
        // Buscamos si existe el usuario con el token
        $user = $user->getUserByToken($token);

        if (empty($user)) {
            $alertas['error'] = 'Token no válido';
            $error = true;
        }

        if ($user && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Limpiamos el token del usuario
            $user->token = '';
            // Actualizamos el token en la DB
            $user->updateToken($user->id, $user->token);
            // Hasheamos la nueva contraseña y guardamos en el objeto de user
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            // Actualizamos el usuario con la nueva contraseña
            $user->updatePassword($user->id, $user->password);
            // Mostramos la alerta de exito
            $alertas['exito'] = 'Contraseña restablecida';
        }

        $router->render('auth/reset', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        session_destroy();

        header('Location: /');
    }
}
