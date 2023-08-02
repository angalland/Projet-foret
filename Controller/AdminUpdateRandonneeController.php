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

            $requeteForet = $pdo->prepare("
                SELECT *
                FROM foret
            ");
            $requeteForet->execute();
            require "view/randonnee/modifierSupprimerRandonneeParId.php";
        }
    }

    // update delete une randonnee
    public function UpdateDeleteRandonneeById($id) {
        if (isset($_POST['submitUpdateRandonneeById'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            $id_randonnee = intval(htmlspecialchars($id));
            $nom_randonnee = htmlspecialchars($_POST['nom_randonnee']);
            $duree = intval(htmlspecialchars($_POST['duree']));
            $difficulte = intval(htmlspecialchars($_POST['difficulte']));
            $id_foret = intval(htmlspecialchars($_POST['foret']));

            if ($duree <= 0){
                $duree = null;
            }

            if ($difficulte <= 0) {
                $difficulte = null;
            }

            if (isset($nom_randonnee) && !empty($nom_randonnee) && isset($id_foret) && !empty($id_foret)){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    UPDATE randonnee
                    SET nom_randonnee = :nom_randonnee,
                        duree = :duree,
                        difficulte = :difficulte,
                        id_foret = :id_foret
                    WHERE id_randonnee = :id_randonnee
                ");
                $requete->bindparam("nom_randonnee", $nom_randonnee);
                $requete->bindparam("duree", $duree);
                $requete->bindparam("difficulte", $difficulte);
                $requete->bindparam("id_foret", $id_foret);
                $requete->bindparam("id_randonnee", $id_randonnee);
                $requete->execute();
                
                $_SESSION['messageSucces'] = "Votre randonnée a bien été modifié";

                header("Location:index.php?action=viewUpdateRandonnee");
                die;

            } else {
                $_SESSION['messageAlert'][] = "Données incorrectes !";
                header("Location:index.php?action=viewUpdateRandonnee");
                die;
            }
        }

        if (isset($_POST['submitDeleteRandonneById'])) {

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            $id_randonnee = intval(htmlspecialchars($id));
            
            if (isset($id_randonnee) && !empty($id_randonnee)){
                
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    DELETE FROM randonnee
                    WHERE id_randonnee = :id
               ");
               $requete->bindparam("id", $id_randonnee);
               $requete->execute();

               $_SESSION['messageSucces'] = "Votre randonnée a bien été supprimée !";
               header("Location:index.php?action=viewUpdateRandonnee");
               die;
            }
        }
    }
}