<?php

namespace Controller;
use Model\Connect;

class AdminTaxonomieController {

    // page ajouter taxonomie
    public function viewTaxonomie(){
        
        // requete bbd classe
        $pdo = Connect::seConnecter();
        $requeteClasse = $pdo->prepare("
            SELECT *
            FROM classe
        ");
        $requeteClasse->execute();
        require "view/taxonomie/ajouterTaxonomie.php";
    }
}