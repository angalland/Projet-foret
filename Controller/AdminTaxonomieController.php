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

        if (isset($_POST['submitAddFamille'])){

            $nom_famille = htmlspecialchars($_POST['nom_famille']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO famille
                    (nom_famille)
                VALUES (:nom_famille)
            ");
            $requete->bindparam("nom_famille", $nom_famille);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre famille a bien été ajoutée !";

            require "view/taxonomie/ajouterTaxonomie.php";
        }

        if (isset($_POST['submitAddEspece'])){
 
            $nom_espece = htmlspecialchars($_POST['nom_espece']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO espece
                    (nom_espece)
                VALUES (:nom_espece)
            ");
            $requete->bindparam("nom_espece", $nom_espece);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre espece a bien été ajoutée !";

            require "view/taxonomie/ajouterTaxonomie.php";
        }

        if (isset($_POST['submitAddCategorie'])){

            $nom_categorie = htmlspecialchars($_POST['nom_categorie']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO categorie
                    (nom_categorie)
                VALUES (:nom_categorie)
            ");
            $requete->bindparam("nom_categorie", $nom_categorie);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre catégorie a bien été ajoutée !";

            require "view/taxonomie/ajouterTaxonomie.php";            
        }
    }

    // afficher la page modifier/supprimer une taxonomie
    public function viewUpdateTaxonomie() {
        $pdo = Connect::seConnecter();
        $requeteClasse = $pdo->prepare("
            SELECT *
            FROM classe
        ");
        $requeteClasse->execute();

        $pdo = Connect::seConnecter();
        $requeteOrdre = $pdo->prepare("
            SELECT *
            FROM ordre
        ");
        $requeteOrdre->execute();

        require "view/taxonomie/modifierSupprimerTaxonomie.php";
    }

    // affiche la taxonomie a modifier ou supprimer par id
    public function viewUpdateTaxonomieById() {
        if (isset($_POST['submitUpdateClasse'])){

            $id_classe = intval(htmlspecialchars($_POST['classe']));
            
            $pdo = Connect::seConnecter();
            $requeteClasse = $pdo->prepare("
                SELECT *
                FROM classe 
                WHERE id_classe = :id_classe       
            ");
            $requeteClasse->bindparam("id_classe", $id_classe);
            $requeteClasse->execute();
            
            require "view/taxonomie/modifierSupprimerTaxonomieParId.php";
        }
    }

    // modifier ou supprime une classe
    public function updateClasse($id) {
        if (isset($_POST['submitUpdateClasse'])){

            $id_classe = intval(htmlspecialchars($id));
            $nom_classe = htmlspecialchars($_POST['nom_classe']);

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                UPDATE classe
                    SET nom_classe = :nom_classe
                WHERE id_classe = :id_classe
            ");
            $requete->bindparam("nom_classe", $nom_classe);
            $requete->bindparam("id_classe", $id_classe);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre classe a bien été modifiée !";

            header("Location:index.php?action=viewUpdateTaxonomie");

        }

        if (isset($_POST['submitDeleteClasse'])){

            $id_classe = intval(htmlspecialchars($id));

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                DELETE FROM classe
                WHERE id_classe = :id_classe
            ");
            $requete->bindparam("id_classe", $id_classe);
            $requete->execute();

            $_SESSION['messageSucces'] = "Votre classe a bien été supprimée !";
            
            header("Location:index.php?action=viewUpdateTaxonomie");
        }
    }
}