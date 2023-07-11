<?php

namespace Controller;
use Model\Connect;

class ArbreController {

    // afficher les arbres de la bbd
    public function listArbre(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
        ");
        $requete->execute();
        
        require "view/foret/listAbre.php";
    }
}