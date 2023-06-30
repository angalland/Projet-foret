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

        $id_foret = filter_var($id);

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM foret
            WHERE id_foret = :id
        ");
        $requete->bindparam("id", $id_foret);
        $requete->execute();

        $requeteRandonnee = $pdo->prepare("
            SELECT *
            FROM randonnee
            WHERE id_foret = :id
        ");
        $requeteRandonnee->bindparam("id", $id_foret);
        $requeteRandonnee->execute();

        require "view/foret/detailForet.php";
    }
}