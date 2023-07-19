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
            WHERE id_categorie = 1;
        ");
        $requete->execute();
        
        require "View/arbre/listArbre.php";
    }

    // affiche les details d'un arbre par id
    public function detailArbre($id){

        $id_etre_vivant = filter_var($id);

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
            WHERE id_categorie = 1
            AND id_etre_vivant = :id;
        ");
        $requete->bindparam("id", $id_etre_vivant);
        $requete->execute();
        
        require "View/arbre/detailArbre.php";
    }
}