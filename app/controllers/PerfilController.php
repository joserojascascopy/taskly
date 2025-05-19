<?php

namespace Controllers;

use MVC\Router;

class PerfilController {
    public static function index(Router $router) {
        

        $router->render('dashboard/perfil', []);
    }
}