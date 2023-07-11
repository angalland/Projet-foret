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
            WHERE id_classe = 1;
        ");
        $requete->execute();
        
        require "View/arbre/listArbre.php";
    }
}