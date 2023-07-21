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

        $requeteCommentaire = $pdo->prepare("
            SELECT *
            FROM commentaire_plante
            INNER JOIN utilisateur
                ON commentaire_plante.id_utilisateur = utilisateur.id_utilisateur
            WHERE id_etre_vivant = :id
        ");
        $requeteCommentaire->bindparam("id", $id_etre_vivant);
        $requeteCommentaire->execute();
            
        require "View/plante/detailPlante.php";
    }

    // poster un commentaire sur la page detail plante
    public function posterCommentaire($id, $id_etre_vivant) {

        if (isset($_POST['submit_commentaire'])){

            $id_utilisateur = filter_var($id);
            $commentaire = htmlspecialchars($_POST['commentaire']);
            $id_etre_vivant = filter_var($id_etre_vivant);

            if ($id_utilisateur && $commentaire && $id_etre_vivant){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO commentaire_plante
                    (id_utilisateur, commentaire, id_etre_vivant)
                    VALUES (:id_utilisateur,
                            :commentaire,
                            :id_etre_vivant)
                    ");
                $requete->bindparam("id_utilisateur", $id_utilisateur);
                $requete->bindparam("commentaire", $commentaire);
                $requete->bindparam("id_etre_vivant", $id_etre_vivant);
                $requete->execute();

                header ("Location:index.php?action=detailPlante&id=$id_etre_vivant");
            }
        }
    }

    // modifie un commentaire de la page detail arbre
    public function modifierCommentaire($id, $id_etre_vivant) {

        if (isset($_POST['submit_update_commentaire'])){

            $id_commentaire_plante = filter_var($id);
            $commentaire = htmlspecialchars($_POST['modifierCommentaire']);
            $id_etre_vivant = filter_var($id_etre_vivant);

            if ($id_commentaire_plante && $commentaire && $id_etre_vivant){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    UPDATE commentaire_plante
                    SET commentaire = :commentaire
                    WHERE id_commentaire_plante = :id
                ");
            $requete->bindparam("commentaire", $commentaire);
            $requete->bindparam("id", $id_commentaire_plante);
            $requete->execute();

            header ("Location:index.php?action=detailPlante&id=$id_etre_vivant");
            }
        }
    }

    // supprimer un commentaire de la page detail arbre
    public function supprimerCommentairePlante($id, $id_etre_vivant) {

        $id_commentaire_plante = filter_var($id);
        $id_etre_vivant = filter_var($id_etre_vivant);

        if ($id_commentaire_plante && $id_etre_vivant){
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                DELETE FROM commentaire_plante
                WHERE id_commentaire_plante = :id
            ");
        $requete->bindparam("id", $id_commentaire_plante);
        $requete->execute();

        header ("Location:index.php?action=detailPlante&id=$id_etre_vivant");
        }
    }

}