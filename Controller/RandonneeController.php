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

    // affiche le detail d'une randonnee
    public function detailRandonne($id) {
        $id_randonnee = intval(htmlspecialchars($id));
        $pdo = Connect::seConnecter();
        $requeteRandonnee = $pdo->prepare("
            SELECT *
            FROM randonnee
            WHERE id_randonnee = :id_randonnee
        ");
        $requeteRandonnee->bindparam("id_randonnee", $id_randonnee);
        $requeteRandonnee->execute();

        require "view/randonnee/detailRandonnee.php";
    }
}