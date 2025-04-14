<?php

use Controllers\LoginController;
use Controllers\RegisterController;
use MVC\Router;

$router = new Router;

// Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

// Registrarse
$router->get('/registrarse', [RegisterController::class, 'register']);
$router->post('/registrarse', [RegisterController::class, 'register']);