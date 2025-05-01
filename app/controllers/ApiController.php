<?php

namespace Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\Tareas;
use Models\User;

class ApiController
{
    public static function auth()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $idToken = $input['token'] ?? null;

        if (!$idToken) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Token no proporcionado']);
            return;
        }

        $publicKeyUrl = "https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com";
        $publicKeys = json_decode(file_get_contents($publicKeyUrl), true);

        $header = json_decode(base64_decode(explode('.', $idToken)[0]), true);
        $keyId = $header['kid'] ?? null;

        if ($keyId && isset($publicKeys[$keyId])) {
            $publicKey = $publicKeys[$keyId];

            try {
                $decoded = JWT::decode($idToken, new Key($publicKey, 'RS256'));

                $email = $decoded->email;
                $nombreCompleto = $decoded->name ?? '';
                $partes = explode(' ', $nombreCompleto);
                $nombre = $partes[0] ?? '';
                $apellido = $partes[1] ?? '';
                $confirmado = 1;

                $user = new User(['nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'confirmado' => $confirmado]);

                $resultado = $user->getUserByEmail($email);

                if (!$resultado) {
                    $user->createUser($user);
                }

                // Guardar en sesión
                session_start();
                $_SESSION = [
                    'id' => $resultado->id,
                    'email' => $decoded->email,
                    'nombre' => $decoded->name ?? '',
                    'login' => true
                ];

                echo json_encode(['success' => true]);
                return;
            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Token inválido']);
                return;
            }
        }

        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Clave pública no encontrada']);
    }

    public static function tasks()
    {
        header('Content-Type: application/json');

        $body = json_decode(file_get_contents('php://input'), true);

        $user_id = $body['user_id'] ?? null;

        $tasks = new Tareas;

        $tasks = $tasks->getTaskByUserId($user_id);

        if (!empty($tasks)) {
            echo json_encode(['success' => true, 'tasks' => $tasks]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public static function update()
    {
        header('Content-Type: application/json');

        $body = json_decode(file_get_contents('php://input'), true);

        $id = $body['id'] ?? null;

        $task = new Tareas;

        $task->actualizarEstado($id);

        echo json_encode(['success' => true]);
    }
}
