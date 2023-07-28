<?php

namespace Controller;
use Model\Connect;

class RandonneeController {

    // affiche la page list des randonnées
    public function listRandonnee(){
        $pdo = Connect::seConnecter();
        $requeteRandonnee = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requeteRandonnee->execute();
        require "view/randonnee/listRandonnee.php";
    }
}