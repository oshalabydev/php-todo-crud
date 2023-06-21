<?php

require $_SERVER["DOCUMENT_ROOT"] . "/todo-app/db/connect.php";

$sql = "SELECT * FROM tasks";
$query = $database->query($sql);

$tasks = $query->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["q"]) && !empty($_GET["q"])) {
  $search_query = $_GET["q"];

  $tasks = array_filter($tasks, fn ($task) => stripos($task["body"], $search_query) !== false);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo CRUD</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script defer src="./js/formAddToggle.js"></script>
    <script defer src="./js/deleteTask.js"></script>
    <script defer src="./js/isdoneTask.js"></script>
    <script defer src="./js/modalEdit.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1e938fdd74.js" crossorigin="anonymous"></script>
  </head>
  <body class="px-3 px-lg-5">
    <h1 class="display-3 text-center my-3 mt-4">Todo CRUD</h1>
    <div class="d-flex justify-content-between border rounded p-2 mt-3">
      <form method="get" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="input-group w-50">
        <input type="search" name="q" autocomplete="off" class="form-control" placeholder="Search" value="<?= $search_query ?? "" ?>" />
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <button id="btn--add-task" class="btn btn-outline-primary">Add Task</button>
    </div>
    <form method="post" action="./actions/add_task.php" id="form--add-task" class="d-none border rounded p-2 mt-3">
      <p class="lead text-center">Add Task</p>
      <div>
        <label for="task-body" class="form-label">Body</label>
        <input
          type="text"
          name="task-body"
          class="form-control"
          placeholder="e.g. Mow the lawn"
          autocomplete="off"
        />
      </div>
      <div class="form-check mt-2 d-flex justify-content-end gap-2">
        <input type="checkbox" name="task-isdone" class="form-check-input" role="button" />
        <label for="task-isdone" class="form-check-label">Mark as done</label>
      </div>
      <input type="submit" value="Add Task" class="btn btn-primary w-100 mt-3" />
    </form>
    <div class="border rounded p-2 mt-3">
      <p class="lead text-center">Tasks</p>
      <?php if (empty($tasks) || !isset($tasks)): ?>
        <p class="fw-light text-center mb-1">No Tasks</p>
      <?php endif ?>
      <?php if (!empty($tasks) && isset($tasks)): ?>
        <ul class="list-group list-group-flush">
        <?php foreach ($tasks as $task): ?>
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <?= $task["body"] ?>
              <div class="d-flex gap-1">
                <button class="checkbox--isdone btn btn-sm <?= $task["isdone"] ? "btn-primary" : "btn-outline-primary" ?>" data-task-id="<?= $task["id"] ?>" data-task-isdone="<?= $task["isdone"] ?>">
                  <i class="fa-solid fa-check"></i> Done
                </button>
                <div class="dropdown">
                  <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">
                    &nbsp;<i class="fa-solid fa-ellipsis-vertical"></i>&nbsp;
                  </button>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item disabled">Added on <?= date("m/d/Y \\a\\t H:i", strtotime($task["date"])) ?></li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="btn--edit-task dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#modal--edit-task" data-task-id="<?= $task["id"] ?>" data-task-body="<?= $task["body"] ?>">
                      <i class="fa-solid fa-pen-to-square"></i> Edit
                    </li>
                    <li class="btn--delete-task dropdown-item text-danger" role="button" data-task-id="<?= $task["id"] ?>">
                      <i class="fa-solid fa-trash"></i> Delete
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach ?>
        </ul>
      <?php endif ?>
    </div>
    <div id="modal--edit-task" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Task</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form method="post" action="./actions/edit_task.php">
            <div class="modal-body">
              <label for="task-body" class="form-label">Body</label>
              <input
                type="text"
                name="task-body"
                class="form-control"
                placeholder="New task body"
                autocomplete="off"
              />
              <input type="hidden" name="task-id" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" role="button" value="Save Changes" class="btn btn-primary"></input>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
