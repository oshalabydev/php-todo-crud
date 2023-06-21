const button = document.querySelector("#btn--add-task");
const form = document.querySelector("#form--add-task");

button.addEventListener("click", () => {
  if (form.classList.contains("d-none")) {
    form.classList.remove("d-none");
  } else {
    form.classList.add("d-none");
  }
});
