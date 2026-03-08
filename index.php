<?php
require_once "controllers/AuthController.php";
require_once "controllers/TaskController.php";
require_once "middleware/AuthMiddleware.php";

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$body = json_decode(file_get_contents("php://input"), true);

// Auth
if ($method === "POST" && strpos($uri, "/login") !== false) {
    AuthController::login($body);
    exit;
}

// Tasks
$userId = authMiddleware();

if ($method === "GET" && strpos($uri, "/tasks") !== false) {
    TaskController::getTasks($userId);
    exit;
}

if ($method === "POST" && strpos($uri, "/tasks") !== false) {
    TaskController::addTask($userId, $body);
    exit;
}

if ($method === "PUT" && preg_match("/\/tasks\/(\d+)\/toggle/", $uri, $matches)) {
    TaskController::toggleTask($userId, $matches[1]);
    exit;
}

if ($method === "DELETE" && preg_match("/\/tasks\/(\d+)/", $uri, $matches)) {
    TaskController::deleteTask($userId, $matches[1]);
    exit;
}

echo json_encode(["message" => "Route not found"]);