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

// modiffier un commentaire
const modalCommentaire = document.querySelectorAll(".formulaireModiffier");
const modalButton = document.querySelectorAll(".modifier");

modalButton.forEach(trigger => trigger.addEventListener("click", modiffier));

function modiffier() {
    modalCommentaire.forEach(trigger => trigger.classList.add("active"));
};