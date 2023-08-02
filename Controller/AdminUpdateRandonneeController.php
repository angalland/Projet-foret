<?php

namespace Controller;
use Model\Connect;

class AdminUpdateRandonneeController {

    // affiche la page modifier/supprimer une randonnée
    public function viewUpdateRandonnee() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requete->execute();

        require "view/randonnee/modifierSupprimerRandonnee.php";
    }

    // affiche la page modifier/supprimer une randonnee par id
    public function viewUpdateRandonneeById(){
        if (isset($_POST['submitUpdateRandonneeById'])){
            $id_randonnee = intval(htmlspecialchars($_POST['randonnee']));
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                SELECT *
                FROM randonnee
                WHERE id_randonnee = :id
            ");
            $requete->bindparam("id", $id_randonnee);
            $requete->execute();
            require "view/randonnee/modifierSupprimerRandonneeParId.php";
        }
    }
}