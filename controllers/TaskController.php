<?php
require_once "../data.php";

class TaskController {
    public static function getTasks($userId) {
        global $tasks;
        $userTasks = array_filter($tasks, fn($t) => $t["user"] == $userId);
        echo json_encode(array_values($userTasks));
    }

    public static function addTask($userId, $body) {
        global $tasks;
        $id = count($tasks) + 1;
        $tasks[] = ["id" => $id, "user" => $userId, "title" => $body["title"], "completed" => false];
        echo json_encode($tasks[$id - 1]);
    }

    public static function toggleTask($userId, $taskId) {
        global $tasks;
        foreach ($tasks as &$t) {
            if ($t["id"] == $taskId && $t["user"] == $userId) {
                $t["completed"] = !$t["completed"];
                echo json_encode($t);
                return;
            }
        }
        echo json_encode(["message" => "Task not found"]);
    }

    public static function deleteTask($userId, $taskId) {
        global $tasks;
        foreach ($tasks as $k => $t) {
            if ($t["id"] == $taskId && $t["user"] == $userId) {
                unset($tasks[$k]);
                echo json_encode(["message" => "Task deleted"]);
                return;
            }
        }
        echo json_encode(["message" => "Task not found"]);
    }
}