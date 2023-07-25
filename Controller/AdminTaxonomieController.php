<?php

namespace Controller;
use Model\Connect;

class AdminTaxonomieController {

    // page ajouter taxonomie
    public function viewTaxonomie(){
        require "view/taxonomie/ajouterTaxonomie.php";
    }

    // ajoute une classe
    public function addClasse(){
        if (isset($_POST['submitAddClasse'])){

            $nom_classe = htmlspecialchars($_POST['nom_classe']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO classe
                    (nom_classe)
                VALUES (:nom_classe)
            ");
            $requete->bindparam("nom_classe", $nom_classe);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre classe a bien été ajoutée !";

            require "view/taxonomie/ajouterTaxonomie.php";
        }

        if (isset($_POST['submitAddOrdre'])){

            $nom_ordre = htmlspecialchars($_POST['nom_ordre']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO ordre
                    (nom_ordre)
                VALUES (:nom_ordre)
            ");
            $requete->bindparam("nom_ordre", $nom_ordre);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre ordre a bien été ajoutée !";

            require "view/taxonomie/ajouterTaxonomie.php";           
        }
    }
}