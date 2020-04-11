const health = document.querySelector('#health');
const imgGood = health.querySelector('#imgGood');
const imgBad = health.querySelector('#imgBad');
const span = document.querySelector("#good");
const modal = document.querySelector("#modal");
const container = document.querySelector("#container");
const closeModal = modal.querySelector(".close-modal");

let showModal = true;
let showForm = localStorage.getItem('showModal');

if (showForm === null) {
  showForm = true;
  health.classList.add("unclicked");
  container.style.opacity = showModal ? 0.8 : 1;
}

imgGood.addEventListener('click', () => {
  health.classList.remove("unclicked");
  if (showForm === true) {
    showForm = false;
    localStorage.setItem('showModal', showForm);
  }
});

imgBad.addEventListener('click', () => {
  health.classList.remove("unclicked");
  if (showForm === true) {
    showForm = false;
    localStorage.setItem('showModal', showForm);
  }
});

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
