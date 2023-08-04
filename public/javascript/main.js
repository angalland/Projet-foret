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
const fermeture = document.querySelectorAll(".fermeture");

modalButton.forEach(trigger => trigger.addEventListener("click", modiffier));
fermeture.forEach(trigger => trigger.addEventListener("click", fermer));

function modiffier() {
    modalCommentaire.forEach(trigger => trigger.classList.add("active"));
};

function fermer() {
    modalCommentaire.forEach(trigger => trigger.classList.remove("active"));
};

// menue burger
const links = document.querySelectorAll('nav li');
const icons = document.getElementById('icons');

icons.addEventListener("click", () => {
    nav.classList.toggle("active");
})

links.forEach((link) => {
    link.addEventListener("click", () => {
        nav.classList.remove("active");
    });
});

