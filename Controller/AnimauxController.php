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

    // affiche les details d'un animal par id
    public function detailAnimaux($id){

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
            WHERE etre_vivant.id_categorie = 3
            AND id_etre_vivant = :id;
        ");
        $requete->bindparam("id", $id_etre_vivant);
        $requete->execute();

        $requeteCommentaire = $pdo->prepare("
            SELECT * 
            FROM commentaire_animaux
            INNER JOIN utilisateur
                ON commentaire_animaux.id_utilisateur = utilisateur.id_utilisateur
            WHERE id_etre_vivant = :id
        ");
        $requeteCommentaire->bindparam("id", $id_etre_vivant);
        $requeteCommentaire->execute();
            
        require "View/animaux/detailAnimaux.php";
    }
}