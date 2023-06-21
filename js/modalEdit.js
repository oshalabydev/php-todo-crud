const editButtons = document.querySelectorAll(".btn--edit-task");
const editModal = document.querySelector("#modal--edit-task");

editButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const taskId = button.dataset.taskId;
    const taskBody = button.dataset.taskBody;

    const inputTaskId = editModal.querySelector("input[name='task-id']");
    const inputTaskBody = editModal.querySelector("input[name='task-body']");

    inputTaskId.value = taskId;
    inputTaskBody.value = taskBody;
  });
});

editModal.addEventListener("shown.bs.modal", () => {
  const inputTaskBody = editModal.querySelector("input[name='task-body']");

  inputTaskBody.focus();
  inputTaskBody.select();
});
