<?php

namespace Controller;
use Model\Connect;

class AdminRandonneeController {

    // affiche la page ajouter une randonnee
    public function viewAddRandonnee(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM foret        
        ");
        $requete->execute();
        require "view/randonnee/ajouterRandonnee.php";
    }

    // ajoute une randonnée
    public function addRandonneeByForet(){
        if (isset($_POST['submitAddRandonneeByForet'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            $nom_randonnee = htmlspecialchars($_POST['nom_randonnee']);
            $duree = intval(filter_var($_POST['duree'], FILTER_SANITIZE_NUMBER_INT));
            $difficulte = intval(filter_var($_POST['difficulte'], FILTER_SANITIZE_NUMBER_INT));
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
                    INSERT INTO randonnee
                    (nom_randonnee, duree, difficulte, id_foret)
                    VALUES (:nom_randonnee,
                            :duree,
                            :difficulte,
                            :id_foret)
                ");
                $requete->bindparam("nom_randonnee", $nom_randonnee);
                $requete->bindparam("duree", $duree);
                $requete->bindparam("difficulte", $difficulte);
                $requete->bindparam("id_foret", $id_foret);
                $requete->execute();

                $_SESSION['messageSucces'] = "Votre randonnée a bien été ajouté";
                header("Location:index.php?action=viewAddRandonnee");
                die();

            } else {
                $_SESSION['messageAlert'][] = "Données incorrectes !";
                header("Location:index.php?action=viewAddRandonnee");
                die();
            }

        }
    }

    // affiche la page pour choisir la randonnée dont on veut rajouter un parcours
    public function viewAddParcours(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requete->execute();
        require "view/randonnee/ajouterParcours.php";
    }


    // affiche la page ajouter un parcours
    public function viewAddParcoursByRandonnee(){
        if (isset($_POST['submitAddParcours'])){

            $id_randonnee = intval(htmlspecialchars($_POST['randonnee']));
            $_SESSION['id_randonnee'] = $id_randonnee;

            require "view/randonnee/ajouterParcoursParRandonnee.php";
        }
    }

    // ajouter des points
    public function addParcours(){
        if (isset($_POST['submitAddParcoursPointDepart'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            // filtrage des donnée
            $id_randonnee = intval(htmlspecialchars($_SESSION['id_randonnee']));
            // unset($_SESSION['id_randonnee']);
            $longitude = (float)(htmlspecialchars($_POST['point_depart_longitude']));
            $lattitude = (float)(htmlspecialchars($_POST['point_depart_lattitude']));

            if (isset($id_randonnee) && !empty($id_randonnee) && isset($longitude) && !empty($longitude) && isset($lattitude) && !empty($lattitude)){

                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO point
                    (etape, longitude, lattitude, id_randonnee)
                    VALUES ('départ',
                            :longitude,
                            :lattitude,
                            :id_randonnee)
                ");
                $requete->bindparam("longitude", $longitude);
                $requete->bindparam("lattitude", $lattitude);
                $requete->bindparam("id_randonnee", $id_randonnee);
                $requete->execute();

                $_SESSION['messageSucces'] = "Votre point de départ a bien été ajouté !";
                header("Location:index.php?action=viewAddParcoursByRandonnee");

            }

        }
    }
}