<?php

namespace Controller;
use Model\Connect;

class AdminUpdateRandonneeController {

    // affiche la page modifier/supprimer une randonnée
    public function viewUpdateRandonnee() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requete->execute();

        require "view/randonnee/modifierSupprimerRandonnee.php";
    }
}