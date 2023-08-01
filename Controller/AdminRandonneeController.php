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
}