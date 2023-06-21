const addButtons = document.querySelectorAll(".btn--delete-task");

addButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const taskId = button.dataset.taskId;

    const action = "/todo-app/actions/delete_task.php";
    const requestBody = `task-id=${taskId}`;

    const ajaxRequest = new XMLHttpRequest();

    ajaxRequest.open("POST", action, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajaxRequest.addEventListener("load", () => {
      location.reload();
    });

    ajaxRequest.send(requestBody);
  });
});
