// modal inscription
// selectionne la modal et tous les boutons de la modal
const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");
// ajoute un evenement click a tous les boutons et fait la fonction toggleModal
modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal));
// ajoute et remove active a chaque click sur les boutons
function toggleModal() {
    modalContainer.classList.toggle("active")
};