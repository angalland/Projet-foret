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

    // page pour ajouter une randonée apres avoir choisit la foret
    public function viewAddRandonneeByForet() {
        if (isset($_POST['submitAddRandonnee'])){
    
            $id_foret = intval(htmlspecialchars($_POST['foret']));
            $_SESSION['id_foret'] = $id_foret;
            require "view/randonnee/ajouterRandonneeParIdForet.php";
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

    // ajoute une randonnée
    public function addRandonneeByid_foret($id){
        if (isset($_POST['submitAddRandonneeById'])){
            var_dump($id);
        }
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