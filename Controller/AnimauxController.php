<?php

namespace Controller;
use Model\Connect;

class AnimauxController {

    // afficher les arbres de la bbd
    public function listAnimaux(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
            WHERE id_categorie = 3;
        ");
        $requete->execute();
        
        require "View/animaux/listAnimaux.php";
    }
}