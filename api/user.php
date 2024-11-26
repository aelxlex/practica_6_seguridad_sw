<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$db = new SQLite3(__DIR__ . '/../db/database.sqlite');
$secretKey = "tu_secreto_super_seguro";

$headers = getallheaders();
$authHeader = $headers["Authorization"] ?? '';

if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $jwt = $matches[1];
    try {
        $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
        echo json_encode([
            "message" => "Bienvenido al panel de usuario",
            "user" => $decoded
        ]);
    } catch (Exception $e) {
        http_response_code(403);
        echo json_encode(["error" => "Token inválido"]);
    }
} else {
    http_response_code(401);
    echo json_encode(["error" => "No autorizado"]);
}
