<?php

use Controller\ForetController;
use Controller\UtilisateurController;
use Controller\ArbreController;
use Controller\PlanteController;
use Controller\AnimauxController;
use Controller\UserController;

session_start();

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlForet = new ForetController();
$ctrlUtilisateur = new UtilisateurController();
$ctrlArbre = new ArbreController();
$ctrlPlante = new PlanteController();
$ctrlAnimal = new AnimauxController();
$ctrlUser = new UserController();

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

        // controller animaux
        case 'listAnimaux' : $ctrlAnimal->listAnimaux();
        break;

        // controller connexion
        case 'connexion' : $ctrlUser->connexion();
        break;

        case 'login' : $ctrlUser->login();
        break;

        case 'inscription' : $ctrlUser->inscription();
        break;

    }
}