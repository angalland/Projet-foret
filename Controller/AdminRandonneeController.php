<?php

namespace Controller;
use Model\Connect;

class AdminRandonneeController {

    // affiche la page ajouter une randonnee
    public function viewAddRandonnee(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM foret        
        ");
        $requete->execute();
        require "view/randonnee/ajouterRandonnee.php";
    }

    // ajoute une randonnée
    public function addRandonneeByForet(){
        if (isset($_POST['submitAddRandonneeByForet'])){
            var_dump($_POST);
        }
    }

    // affiche la page pour choisir la randonnée dont on veut rajouter un parcours
    public function viewAddParcours(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requete->execute();
        require "view/randonnee/ajouterParcours.php";
    }


    // affiche la page ajouter un parcours
    public function viewAddParcoursByRandonnee(){
        if (isset($_POST['submitAddParcours'])){
            $id_randonnee = intval(htmlspecialchars($_POST['randonnee']));
            $_SESSION['id_randonnee'] = $id_randonnee;
            require "view/randonnee/ajouterParcoursParRandonnee.php";
        }
    }
}