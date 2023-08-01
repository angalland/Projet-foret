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
            $nom_randonnee = htmlspecialchars($_POST['nom_randonnee']);
            $duree = intval(filter_var($_POST['duree'], FILTER_SANITIZE_NUMBER_INT));
            $difficulte = intval(filter_var($_POST['difficulte'], FILTER_SANITIZE_NUMBER_INT));
            $id_foret = intval(htmlspecialchars($_POST['foret']));
            var_dump($nom_randonnee);
            var_dump($duree);
            var_dump($difficulte);
            var_dump($id_foret);
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