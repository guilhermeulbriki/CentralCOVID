let showModal = true;

const span = document.querySelector("#good");
const modal = document.querySelector("#modal");
const container = document.querySelector("#container");
const closeModal = modal.querySelector(".close-modal");

span.addEventListener("click", () => {
  container.style.opacity = showModal ? 0.7 : 1;
  modal.classList.toggle("show", showModal);
  showModal = !showModal;
});

closeModal.addEventListener("click", () => {
  modal.classList.toggle("show", showModal);
  showModal = !showModal;
  container.style.opacity = 1;
});
