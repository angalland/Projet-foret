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

// modal pour modifier le mot de passe
const moduleConteneur = document.querySelector(".module-conteneur");
const moduleTriggers = document.querySelectorAll(".module-trigger");
// ajoute un evenement click a tous les boutons et fait la fonction toggleModal
moduleTriggers.forEach(trigger => trigger.addEventListener("click", toggleModule));
// ajoute et remove active a chaque click sur les boutons
function toggleModule() {
    moduleConteneur.classList.toggle("active")
};

// modal pour supprimer un compte
const moduleConteneurMdp = document.querySelector(".module-conteneur-mdp");
const moduleTriggersMdp = document.querySelectorAll(".modulemdp-trigger");
// ajoute un evenement click a tous les boutons et fait la fonction toggleModal
moduleTriggersMdp.forEach(trigger => trigger.addEventListener("click", toggleModuleMdp));
// ajoute et remove active a chaque click sur les boutons
function toggleModuleMdp() {
    moduleConteneurMdp.classList.toggle("active")
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
const main = document.getElementById('main');

icons.addEventListener("click", () => {
    nav.classList.toggle("active");
})

links.forEach((link) => {
    link.addEventListener("click", () => {
        nav.classList.remove("active");
    });
});

main.addEventListener("click", () => {
    nav.classList.remove("active");
});

// page user fonction click sur icon parametre
const userUpdate = document.getElementById("UserUpdate");
const icon = document.getElementById("iconsUser");
const parametre = document.getElementById("parametre");

icon.addEventListener("click", () => {
    userUpdate.classList.toggle("active");
});