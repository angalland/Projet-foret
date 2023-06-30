<?php

namespace Controller;
use Model\Connect;

class ForetController {
    
    // affiche la list des foret
    public function listForet() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM foret
        ");
        $requete->execute();
        
        require "view/foret/listForet.php";
    }

    // affiche detail film 
    public function detailFilm($id) {
        require "view/foret/detailForet.php";
    }
}