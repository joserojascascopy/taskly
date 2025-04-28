<?php 

namespace Controllers;

use Models\Tareas;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        
        $router->render('dashboard/index', [
        ]);
    }

    public static function create(Router $router) {
        session_start();

        $user_id = $_SESSION['id'];
    
        $tareas = new Tareas;

        $alertas = Tareas::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tareas = new Tareas($_POST);

            $alertas = $tareas->validateTask();

            if(empty($alertas)) {
                $tareas = new Tareas($_POST);
            }
        }

        $router->render('dashboard/crear-tarea', [
            'alertas' => $alertas,
            'user_id' => $user_id
        ]);
    }
}