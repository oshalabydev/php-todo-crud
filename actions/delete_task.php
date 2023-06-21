<?php

require $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/connect.php";

if (!isset($_POST["task-id"])) {
  die("Error: illegal visit; no data provided");
}

$task_id = filter_input(INPUT_POST, "task-id", FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "DELETE FROM tasks WHERE tasks.id = $task_id";

if (!$database->query($sql)) {
  die("Error: " . $database->error);
}
