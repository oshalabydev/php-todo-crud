<?php

require $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/connect.php";

if (!isset($_POST["task-id"]) || !isset($_POST["task-body"])) {
  die("Error: illegal visit; no data provided");
}

if (empty($_POST["task-body"])) {
  die("Error: empty task body");
}

$task_id = filter_input(INPUT_POST, "task-id", FILTER_SANITIZE_SPECIAL_CHARS);
$task_body = filter_input(INPUT_POST, "task-body", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE tasks SET body = '$task_body' WHERE tasks.id = '$task_id'";

if (!$database->query($sql)) {
  die("Error: " . $database->error);
}

header("Location: /todo-app");
