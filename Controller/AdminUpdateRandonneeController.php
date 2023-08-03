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
                try {
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

                } catch (\PDOException $ex){
                    $_SESSION['messageAlert'] [] = "Vous ne pouvez pas supprimer cette randonnée car elle possede un ou des parcours associés. Veuillez d'abord suprimez c'est parcours pour pouvoir supprimer cette randonnée";
                    header("Location:index.php?action=viewUpdateRandonnee");
                    die;
                }
            }
        }
    }

    // affiche la page choisir la randonnee dont on doit supprimer un parcours
    public function viewDeleteParcours(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requete->execute();
        require "view/randonnee/supprimerParcours.php";
    }

    // affiche la page supprimer un parcours celon la randonnee
    public function viewDeleteParcoursByRandonnee(){

        if (isset($_POST['submitDeleteParcours'])){

            $id_randonnee = intval(htmlspecialchars($_POST['randonnee']));
            
            if (isset($id_randonnee)){
                $pdo = Connect::seConnecter();

                $requeteRandonnee = $pdo->prepare("
                    SELECT *
                    FROM randonnee
                    WHERE id_foret = :id
                ");
                $requeteRandonnee->bindparam("id", $id_foret);
                $requeteRandonnee->execute();

                $requetePointDepart = $pdo->prepare("
                    SELECT *
                    FROM point
                    WHERE id_randonnee = :id
                    AND etape = 'Départ'
                ");
                $requetePointDepart->bindparam("id", $id_randonnee);
                $requetePointDepart->execute();

                $requetePointRandonnee = $pdo->prepare("
                    SELECT *
                    FROM point
                    WHERE id_randonnee = :id
                ");
                $requetePointRandonnee->bindparam("id", $id_randonnee);
                $requetePointRandonnee->execute();
                $res = $requetePointRandonnee->fetchAll(\PDO::FETCH_ASSOC);

                $_SESSION['ligne'] = $res;

                $requetePointArrivee = $pdo->prepare("
                    SELECT *
                    FROM point
                    WHERE id_randonnee = :id
                    AND etape = 'Arrivée'
                ");
                $requetePointArrivee->bindparam("id", $id_randonnee);
                $requetePointArrivee->execute(); 
               
                $_SESSION['id_randonnee'] = $id_randonnee;
                require "view/randonnee/supprimerParcoursParRandonnee.php";
            }   
        }
    }

    // supprimer un point ou tous les points
    public function deletePoint($id){
        if (isset($_POST['submitDeletePoint'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            // filtre des données
            $id_randonnee = intval(htmlspecialchars($id));
            $longitude = (float)(htmlspecialchars($_POST['point_longitude']));
            $lattitude = (float)(htmlspecialchars($_POST['point_lattitude']));

            if (isset($id_randonnee) && !empty($id_randonnee) && isset($longitude) && !empty($longitude) && isset($lattitude) && !empty($lattitude)){
                try {
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    DELETE FROM point
                    WHERE id_randonnee = :id_randonnee
                    AND longitude = :longitude
                    AND lattitude = :lattitude
                ");
                $requete->bindparam("id_randonnee", $id_randonnee);
                $requete->bindparam("longitude", $longitude);
                $requete->bindparam("lattitude", $lattitude);
                $requete->execute();

                $_SESSION['messageSucces'] = "Votre point a bien été supprimer !";
                header("Location:index.php?action=viewDeleteParcours");
                } catch (\PDOException $ex) {
                    $_SESSION['messageAlert'] [] = "Les coordonnées saisies ne correspondent a aucun point de la randonnée. Veuillez-saisir des coordonnées correspondant a un point marqué par une popup";
                    header("Location:index.php?action=viewDeleteParcours");
                }
            }
        }

        if (isset($_POST['submitDeleteAllPoint'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            // filtre les données
            $id_randonnee = intval(htmlspecialchars($id));

            if (isset($id_randonnee) && !empty($id_randonnee)){
                try{
                    $pdo = Connect::seConnecter();
                    $requete = $pdo->prepare("
                        DELETE FROM point
                        WHERE id_randonnee = :id
                    ");
                    $requete->bindparam("id", $id_randonnee);
                    $requete->execute();

                    $_SESSION['messageSucces'] = "Tout les points de la randonnée ont bien été suprimé !";
                    header("Location:index.php?action=viewDeleteParcours");
                } catch (\PDOException $ex) {
                    header("Location:index.php?action=viewDeleteParcours");
                }
            }
            
        }
    }
}   