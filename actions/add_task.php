<?php

require $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/connect.php";

if (!isset($_POST["task-body"])) {
  die("Error: illegal visit; no data provided");
}

if (empty($_POST["task-body"])) {
  die("Error: task body is empty");
}

$task_body = filter_input(INPUT_POST, "task-body", FILTER_SANITIZE_SPECIAL_CHARS);
$task_isdone = filter_input(INPUT_POST, "task-isdone", FILTER_SANITIZE_SPECIAL_CHARS);
$task_isdone = $task_isdone ? 1 : 0;

$data = ["body" => $task_body, "isdone" => $task_isdone];
$sql = "INSERT INTO tasks (body, isdone) VALUES ('$data[body]', '$data[isdone]')";

if (!$database->query($sql)) {
  die("Error: " . $database->error);
}

header("Location: /todo-app");
