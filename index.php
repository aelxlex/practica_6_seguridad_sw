<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

$requestPath = str_replace("/practica_6_seguridad_sw", "", $requestPath);

// Dividir la ruta
$request = explode("/", trim($requestPath, "/"));

// Ver la variable $request para depuración
error_log("Request Path: " . print_r($request, true));

// Rutas
if ($request[0] === "auth") {
    require_once "api/auth.php";  // Endpoint para autenticación
} elseif ($request[0] === "user") {
    require_once "api/user.php";  // Endpoint para datos protegidos
} else {
    echo json_encode(["error" => "Endpoint no encontrado"]);
}
