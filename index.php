<?php

use Controller\ForetController;
use Controller\UtilisateurController;
use Controller\ArbreController;
use Controller\PlanteController;
use Controller\AnimauxController;
use Controller\UserController;
use Controller\AdminForetController;
use Controller\AdminTaxonomieController;
use Controller\AdminEtreVivantController;
use Controller\RandonneeController;
use Controller\AdminRandonneeController;

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
$ctrlAdminforet = new AdminForetController();
$ctrlAdminTaxonomie = new AdminTaxonomieController();
$ctrlAdminEtreVivant = new AdminEtreVivantController();
$ctrlRandonnee = new RandonneeController();
$ctrlAdminRandonnee = new AdminRandonneeController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
$id_foret = (isset($_GET["id_foret"])) ? $_GET["id_foret"] : null;
$id_etre_vivant = (isset($_GET["id_etre_vivant"])) ? $_GET["id_etre_vivant"] : null;

if(isset($_GET['action'])){
    switch ($_GET['action']) {

        // controller utilisateur
        case 'accueille' : $ctrlUtilisateur->viewAccueille();
        break;

        // crontoller foret
        case 'listForet' : $ctrlForet->listForet();
        break;

        case 'detailForet' : $ctrlForet->detailForet($id);
        break;

        case 'posterCommentaire' : $ctrlForet->posterCommentaire($id, $id_foret);
        break;

        case 'modifierCommentaireForet' : $ctrlForet->modifierCommentaire($id, $id_foret);
        break;

        case 'supprimerCommentaireForet' : $ctrlForet->supprimerCommentaireForet($id, $id_foret);
        break;

        // controller arbre
        case 'listArbre' : $ctrlArbre->listArbre();
        break;

        case 'detailArbre' : $ctrlArbre->detailArbre($id);
        break;

        case'posterCommentaireArbre' : $ctrlArbre->posterCommentaire($id, $id_etre_vivant);
        break;

        case 'modifierCommentaireArbre' : $ctrlArbre->modifierCommentaire($id, $id_etre_vivant);
        break;

        case 'supprimerCommentaireArbre' : $ctrlArbre->supprimerCommentaireArbre($id, $id_etre_vivant);
        break;

        // controller plante 
        case 'listPlante' : $ctrlPlante->listPlante();
        break;

        case 'detailPlante' : $ctrlPlante->detailPlante($id);
        break;

        case 'posterCommentairePlante' : $ctrlPlante->posterCommentaire($id, $id_etre_vivant);
        break;

        case 'modifierCommentairePlante' : $ctrlPlante->modifierCommentaire($id, $id_etre_vivant);
        break;

        case 'supprimerCommentairePlante' : $ctrlPlante->supprimerCommentairePlante($id, $id_etre_vivant);
        break;

        // controller animaux
        case 'listAnimaux' : $ctrlAnimal->listAnimaux();
        break;

        case 'detailAnimaux' : $ctrlAnimal->detailAnimaux($id);
        break;

        case 'posterCommentaireAnimaux' : $ctrlAnimal->posterCommentaire($id, $id_etre_vivant);
        break;

        case 'modifierCommentaireAnimaux' : $ctrlAnimal->modifierCommentaire($id, $id_etre_vivant);
        break;

        case 'supprimerCommentaireAnimaux' : $ctrlAnimal->supprimerCommentaireAnimaux($id, $id_etre_vivant);
        break;

        // controller connexion
        case 'connexion' : $ctrlUser->connexion();
        break;

        case 'login' : $ctrlUser->login();
        break;

        case 'inscription' : $ctrlUser->inscription();
        break;

        case 'deconnexion' : $ctrlUser->viewLogout();
        break;

        case 'logout' : $ctrlUser->logout();
        break;

        case 'utilisateur' : $ctrlUser->user();
        break;

        // controller Admin foret
        case'viewAddForet' : $ctrlAdminforet->viewAddForet();
        break;

        case 'addForet' : $ctrlAdminforet->addForet();
        break;

        case 'viewUpdateForet' : $ctrlAdminforet->viewUpdateForet();
        break;

        case'viewUpdateForetById' : $ctrlAdminforet->viewUpdateForetById();
        break;

        case 'updateForet' : $ctrlAdminforet->updateForet($id);
        break;

        // controller taxonomie
        case 'viewTaxonomie' : $ctrlAdminTaxonomie->viewTaxonomie();
        break;

        case 'addClasse' : $ctrlAdminTaxonomie->addClasse();
        break;

        case 'viewUpdateTaxonomie' : $ctrlAdminTaxonomie->viewUpdateTaxonomie();
        break;

        case 'viewUpdateTaxonomieById' : $ctrlAdminTaxonomie->viewUpdateTaxonomieById();
        break;

        case 'updateClasse' : $ctrlAdminTaxonomie->updateClasse($id);
        break;

        // controller etre vivant
        case 'viewAddEtreVivant' : $ctrlAdminEtreVivant->viewAddEtreVivant();
        break;

        case 'addEtreVivant' : $ctrlAdminEtreVivant->addEtreVivant();
        break;

        case 'viewUpdateEtreVivant' : $ctrlAdminEtreVivant->viewUpdateEtreVivant();
        break;

        case 'viewUpdateEtreVivantById' : $ctrlAdminEtreVivant->viewUpdateEtreVivantById();
        break;

        case 'updateDeleteEtreVivant' : $ctrlAdminEtreVivant->updateDeleteEtreVivant($id);
        break;

        // controller Randonnee
        case 'listRandonnee' : $ctrlRandonnee->listRandonnee();
        break;

        case 'detailRandonne' : $ctrlRandonnee->detailRandonne($id);
        break;

        // admin controller randonnee
        case 'viewAddRandonnee' : $ctrlAdminRandonnee->viewAddRandonnee();
        break;
    }
}