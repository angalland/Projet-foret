<?php

use Controller\ForetController;
use Controller\UtilisateurController;
use Controller\ArbreController;
use Controller\PlanteController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlForet = new ForetController();
$ctrlUtilisateur = new UtilisateurController();
$ctrlArbre = new ArbreController();
$ctrlPlante = new PlanteController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET['action'])){
    switch ($_GET['action']) {

        // controller utilisateur
        case 'accueille' : $ctrlUtilisateur->viewAccueille();
        break;

        // crontoller foret
        case 'listForet' : $ctrlForet->listForet();
        break;

        case 'detailForet' : $ctrlForet->detailFilm($id);
        break;

        // controller arbre
        case 'listArbre' : $ctrlArbre->listArbre();
        break;

        // controller plante 
        case 'listPlante' : $ctrlPlante->listPlante();
        break;

    }
}