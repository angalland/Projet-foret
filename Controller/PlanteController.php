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

    // affiche les details des plantes par id
    public function detailPlante($id){

        $id_etre_vivant = filter_var($id);

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
            INNER JOIN categorie
                ON etre_vivant.id_categorie = categorie.id_categorie
            INNER JOIN classe
                ON etre_vivant.id_classe = classe.id_classe
            INNER JOIN ordre
                ON etre_vivant.id_ordre = ordre.id_ordre
            INNER JOIN famille
                ON etre_vivant.id_famille = famille.id_famille
            INNER JOIN espece
                ON etre_vivant.id_espece = espece.id_espece
            WHERE etre_vivant.id_categorie = 2
            AND id_etre_vivant = :id;
        ");
        $requete->bindparam("id", $id_etre_vivant);
        $requete->execute();
            
        require "View/plante/detailPlante.php";
    }
}