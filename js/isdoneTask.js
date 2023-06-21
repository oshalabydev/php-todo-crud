const isdoneCheckboxes = document.querySelectorAll(".checkbox--isdone");

isdoneCheckboxes.forEach((checkbox) => {
  checkbox.addEventListener("click", () => {
    if (checkbox.classList.contains("btn-primary")) {
      checkbox.classList.replace("btn-primary", "btn-outline-primary");
    } else {
      checkbox.classList.replace("btn-outline-primary", "btn-primary");
    }

    const taskId = checkbox.dataset.taskId;
    const taskIsdone = checkbox.dataset.taskIsdone;

    const action = "/todo-app/actions/isdone_task.php";
    const requestBody = `task-id=${taskId}&task-isdone=${taskIsdone}`;

    const ajaxRequest = new XMLHttpRequest();

    ajaxRequest.open("POST", action, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(requestBody);
  });
});
