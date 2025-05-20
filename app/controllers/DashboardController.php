<?php 

namespace Controllers;

use Models\Tareas;
use Models\User;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        session_start();

        $user_id = $_SESSION['id'];

        $user = new User;

        $user = $user->getUserById($user_id);

        $router->render('dashboard/index', [
            'user_id' => $user_id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido
        ]);
    }

    public static function create(Router $router) {
        session_start();

        $user_id = $_SESSION['id'];

        $user = new User;

        $user = $user->getUserById($user_id);
    
        $task = new Tareas;

        $alertas = Tareas::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = new Tareas($_POST);

            $alertas = $task->validateTask();

            if(empty($alertas)) {
                $resultado = $task->createTask($task);

                if($resultado) {
                    $alertas['exito'] = 'Tarea creada correctamente';
                }
            }
        }

        $router->render('dashboard/crear-tarea', [
            'alertas' => $alertas,
            'user_id' => $user_id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido
        ]);
    }
}