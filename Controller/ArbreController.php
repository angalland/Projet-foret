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
            WHERE etre_vivant.id_categorie = 1
            AND id_etre_vivant = :id;
        ");
        $requete->bindparam("id", $id_etre_vivant);
        $requete->execute();
        
        $requeteCommentaire = $pdo->prepare("
            SELECT * 
            FROM commentaire_arbre
            INNER JOIN utilisateur
                ON commentaire_arbre.id_utilisateur = utilisateur.id_utilisateur
            WHERE id_etre_vivant = :id
        ");
        $requeteCommentaire->bindparam("id", $id_etre_vivant);
        $requeteCommentaire->execute();

        require "View/arbre/detailArbre.php";
    }

    // poster un commentaire sur la page detail arbre
    public function posterCommentaire($id, $id_etre_vivant) {

        if (isset($_POST['submit_commentaire'])){
    
            $id_utilisateur = filter_var($id);
            $commentaire = htmlspecialchars($_POST['commentaire']);
            $id_etre_vivant = filter_var($id_etre_vivant);
    
            if ($id_utilisateur && $commentaire && $id_etre_vivant){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO commentaire_arbre
                    (id_utilisateur, commentaire, id_etre_vivant)
                    VALUES (:id_utilisateur,
                            :commentaire,
                            :id_etre_vivant)
                    ");
                    $requete->bindparam("id_utilisateur", $id_utilisateur);
                    $requete->bindparam("commentaire", $commentaire);
                    $requete->bindparam("id_etre_vivant", $id_etre_vivant);
                    $requete->execute();
    
                    header ("Location:index.php?action=detailArbre&id=$id_etre_vivant");
                }
            }
        }

    // modifie un commentaire de la page detail arbre
    public function modifierCommentaire($id, $id_etre_vivant) {

        if (isset($_POST['submit_update_commentaire'])){

            $id_commentaire_arbre = filter_var($id);
            $commentaire = htmlspecialchars($_POST['modifierCommentaire']);
            $id_etre_vivant = filter_var($id_etre_vivant);

            if ($id_commentaire_arbre && $commentaire && $id_etre_vivant){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    UPDATE commentaire_arbre
                    SET commentaire = :commentaire
                    WHERE id_commentaire_arbre = :id
                ");
                $requete->bindparam("commentaire", $commentaire);
                $requete->bindparam("id", $id_commentaire_arbre);
                $requete->execute();

                header ("Location:index.php?action=detailArbre&id=$id_etre_vivant");
            }
        }
    }
}