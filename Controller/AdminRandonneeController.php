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
}