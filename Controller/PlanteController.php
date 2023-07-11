<?php

namespace Controller;
use Model\Connect;

class PlanteController {

    // afficher les arbres de la bbd
    public function listPlante(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
            WHERE id_categorie = 2;
        ");
        $requete->execute();
            
        require "View/plante/listPlante.php";
    }
}