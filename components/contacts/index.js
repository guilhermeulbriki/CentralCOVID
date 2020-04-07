const spanFw = document.querySelector("#fw");
const spanPalmeira = document.querySelector("#palmeira");
const spanSantaRosa = document.querySelector("#santaRosa");

const contentFw = document.querySelector("#fw-content");
const contentPalmeira = document.querySelector("#palmeira-content");
const contentSantaRosa = document.querySelector("#santaRosa-content");

const div = document.querySelector(".contact-container");

spanFw.addEventListener("click", () => scrollTo(contentFw));
spanPalmeira.addEventListener("click", () => scrollTo(contentPalmeira));
spanSantaRosa.addEventListener("click", () => scrollTo(contentSantaRosa));

function scrollTo(component) {
  div.scrollTo(0, (component.getBoundingClientRect().y));
}
