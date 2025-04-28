<?php

namespace Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\User;

class ApiController {
    public static function auth() {
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
                // Guardar en sesión si querés
                session_start();
                $_SESSION = [
                    'uid' => $decoded->sub,
                    'email' => $decoded->email,
                    'name' => $decoded->name ?? '',
                    'login' => true
                ];

                $email = $decoded->email;
                $nombreCompleto = $decoded->name ?? '';
                $partes = explode(' ', $nombreCompleto);
                $nombre = $partes[0] ?? '';
                $apellido = $partes[1] ?? '';
                $confirmado = 1;

                $user = new User(['nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'confirmado' => $confirmado]);

                $resultado = $user->getUserByEmail($email);

                if(!$resultado) {
                    $user->createUser($user);
                }

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
}
