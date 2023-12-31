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

    // affiche detail foret 
    public function detailForet($id) {

        $id_foret = intval(htmlspecialchars($id));

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
        $res = $requeteRandonnee->fetchAll();

        $randonneeForet = [];

        foreach ($res as $randonnee){
            $id_randonnee = $randonnee['id_randonnee'];
            $randonneeForet[$id_randonnee]['id_randonnee'] = $id_randonnee;
            $requetePointDepart = $pdo->prepare("
                    SELECT *
                    FROM point
                    INNER JOIN randonnee
                        ON point.id_randonnee = randonnee.id_randonnee
                    WHERE randonnee.id_randonnee = :id
                    AND etape = 'Départ'
            ");
            $requetePointDepart->bindparam("id", $id_randonnee);
            $requetePointDepart->execute();
            
            $randonneeForet[$id_randonnee]['pointDepart']=$requetePointDepart->fetchAll();     
            $requetePointRandonnee = $pdo->prepare("
                SELECT *
                FROM point
                INNER JOIN randonnee
                    ON point.id_randonnee = randonnee.id_randonnee
                WHERE randonnee.id_randonnee = :id
            ");
            $requetePointRandonnee->bindparam("id", $id_randonnee);
            $requetePointRandonnee->execute();
            $randonneeForet[$id_randonnee]['pointRandonnee']=$requetePointRandonnee->fetchAll();       
            $requetePointArrivee = $pdo->prepare("
                SELECT *
                FROM point
                INNER JOIN randonnee
                    ON point.id_randonnee = randonnee.id_randonnee
                WHERE randonnee.id_randonnee = :id
                AND etape = 'Arrivée'
            ");
            $requetePointArrivee->bindparam("id", $id_randonnee);
            $requetePointArrivee->execute();
            $randonneeForet[$id_randonnee]['pointArrivee']=$requetePointArrivee->fetchAll();
        }

        $requeteCommentaire = $pdo->prepare("
            SELECT *
            FROM commentaire_foret
            INNER JOIN utilisateur
                ON commentaire_foret.id_utilisateur = utilisateur.id_utilisateur
            WHERE id_foret = :id
        ");
        $requeteCommentaire->bindparam("id", $id_foret);
        $requeteCommentaire->execute();

        require "view/foret/detailForet.php";
    }

    // poster un commentaire sur la page detail foret
    public function posterCommentaire($id, $id_foret) {

        if (isset($_POST['submit_commentaire'])){

            $id_utilisateur = filter_var($id);
            $commentaire = htmlspecialchars($_POST['commentaire']);
            $id_foret = filter_var($id_foret);

            if ($id_utilisateur && $commentaire && $id_foret){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO commentaire_foret
                    (id_utilisateur, commentaire, id_foret)
                    VALUES (:id_utilisateur,
                            :commentaire,
                            :id_foret)
                ");
                $requete->bindparam("id_utilisateur", $id_utilisateur);
                $requete->bindparam("commentaire", $commentaire);
                $requete->bindparam("id_foret", $id_foret);
                $requete->execute();

                header ("Location:index.php?action=detailForet&id=$id_foret");
            }
        }
    }

    // modifie un commentaire de la page detail foret
    public function modifierCommentaire($id, $id_foret) {

        if (isset($_POST['submit_update_commentaire'])){

            $id_commentaire_foret = filter_var($id);
            $commentaire = htmlspecialchars($_POST['modifierCommentaire']);
            $id_foret = filter_var($id_foret);

            if ($id_commentaire_foret && $commentaire && $id_foret){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    UPDATE commentaire_foret
                    SET commentaire = :commentaire
                    WHERE id_commentaire_foret = :id
                ");
                $requete->bindparam("commentaire", $commentaire);
                $requete->bindparam("id", $id_commentaire_foret);
                $requete->execute();

                header ("Location:index.php?action=detailForet&id=$id_foret");
            }
        }
    }

    // supprimer un commentaire de la page detail foret
    public function supprimerCommentaireForet($id, $id_foret) {

        $id_commentaire_foret = filter_var($id);
        $id_foret = filter_var($id_foret);

        if ($id_commentaire_foret){
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                DELETE FROM commentaire_foret
                WHERE id_commentaire_foret = :id
            ");
            $requete->bindparam("id", $id_commentaire_foret);
            $requete->execute();

            header ("Location:index.php?action=detailForet&id=$id_foret");
        }
    }
}