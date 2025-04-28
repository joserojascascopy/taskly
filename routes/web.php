<?php

use Controllers\ApiController;
use Controllers\DashboardController;
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

// Confirmar Cuenta

$router->get('/confirm-account', [RegisterController::class, 'confirm']);

// Olvide Contraseña

$router->get('/forgot-password', [LoginController::class, 'forgot']);
$router->post('/forgot-password', [LoginController::class, 'forgot']);

// Restablecer Contraseña

$router->get('/reset-password', [LoginController::class, 'reset']);
$router->post('/reset-password', [LoginController::class, 'reset']);

// Cerrar Sesión

$router->get('/logout', [LoginController::class, 'logout']);

// Dashboard

$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-tarea', [DashboardController::class, 'create']);
$router->post('/crear-tarea', [DashboardController::class, 'create']);

// Api

$router->post('/api/auth', [ApiController::class, 'auth']);
$router->get('/api/auth', [ApiController::class, 'auth']);