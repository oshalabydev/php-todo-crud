<?php

require $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/connect.php";

if (!isset($_POST["task-id"])) {
  die("Error: illegal visit; no data provided");
}

$task_id = filter_input(INPUT_POST, "task-id", FILTER_SANITIZE_SPECIAL_CHARS);
$task_isdone = filter_input(INPUT_POST, "task-isdone", FILTER_SANITIZE_SPECIAL_CHARS);
$task_isdone = $task_isdone ? 0 : 1;

$sql = "UPDATE tasks SET isdone = '$task_isdone' WHERE tasks.id = $task_id";

if (!$database->query($sql)) {
  die("Error: " . $database->error);
}
