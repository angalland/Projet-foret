<?php

use Controller\ForetController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlForet = new ForetController();
$ctrlUtilisateur = new UtilisateurController();

if(isset($_GET['action'])){
    switch ($_GET['action']) {

        // controller utilisateur
        case 'acceuille' : $ctrlForet->viewAccueille();
        break;

        // crontoller foret
        case 'listForet' : $ctrlForet->listForet();
        break;

        case 'detailForet' : $ctrlForet->detailFilm();
        break;

    }
}