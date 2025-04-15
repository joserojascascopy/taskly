<?php

namespace Controllers;

use Models\User;
use MVC\Router;
use Classes\Email;

class RegisterController {
    public static function register(Router $router) {
        // Instanciamos el objeto user vario
        $user = new User;
        // Traemos el array de alertas desde el modelo
        $alertas = User::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Guardamos los datos enviados del formulario al objeto user
            $user = new User($_POST);
            // Validamos que todos los campos esten completos
            $alertas = $user->validateUser();

            if(empty($alertas)) {
                // Si alertas esta vacio, verificamos si el usuario ya esta registrado con el email
                $isRegister = $user->getUserByEmail($user->email);

                if(!$isRegister) {
                    // Si no esta registrado, generamos un token para poder confirmar su cuenta
                    $user->generateToken();
                    // Enviamos el email (Libreria PHPMailer)
                    $email = new Email($user->nombre, $user->apellido, $user->email, $user->token);
                    $resultado = $email->enviarConfirmacion();

                    if($resultado) {
                        // Insertamos en la base de datos
                        $resultado = $user->createUser($user);
                    
                        if($resultado) {
                            // Alerta para confirmar su cuenta
                            $alertas['exito'] = 'Le hemos enviado un correo para confirmar su cuenta.';
                        }
                    }

                }else {
                    $alertas['error'] = 'Ya tienes una cuenta con este correo.';
                }
            }
        }

        $router->render('auth/register', [
            'alertas' => $alertas
        ]);
    }
}