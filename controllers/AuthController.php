<?php
require_once "../data.php";

class AuthController {
    public static function login($body) {
        global $users;
        // Kolla bara email & password mot array
        foreach ($users as $u) {
            if ($u["email"] === $body["email"] && $u["password"] === $body["password"]) {
                echo json_encode(["message" => "Login successful", "userId" => $u["id"]]);
                exit;
            }
        }
        echo json_encode(["message" => "Login failed"]);
    }
}