<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;

$db = new SQLite3(__DIR__ . '/../db/database.sqlite');
$secretKey = "tu_secreto_super_seguro";

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $data->username ?? '';
    $password = $data->password ?? '';

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result) {
        $payload = [
            "id" => $result["id"],
            "role" => $result["role"],
            "iat" => time(),
            "exp" => time() + 3600 // Expira en 1 hora
        ];
        $jwt = JWT::encode($payload, $secretKey, 'HS256');
        echo json_encode(["token" => $jwt]);
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Credenciales incorrectas"]);
    }
}
