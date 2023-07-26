<?php

namespace Controller;
use Model\Connect;


class AdminEtreVivantController {

    // affiche la page ajouter etre vivant
    public function viewAddEtreVivant(){

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

        $pdo = Connect::seConnecter();
        $requeteFamille = $pdo->prepare("
            SELECT *
            FROM famille
        ");
        $requeteFamille->execute();
        
        $pdo = Connect::seConnecter();
        $requeteEspece = $pdo->prepare("
            SELECT *
            FROM espece
        ");
        $requeteEspece->execute();
        
        $pdo = Connect::seConnecter();
        $requeteCategorie = $pdo->prepare("
            SELECT *
            FROM categorie
        ");
        $requeteCategorie->execute();

        require "view/etre_vivant/ajouterEtreVivant.php";
    }

    // ajoute un etre vivant
    public function addEtreVivant() {
        // on verifie que le boutton ajouter a été appuyer
        if (isset($_POST['submitAddEtreVivant'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            $nom_courant = htmlspecialchars($_POST['nom_courant']);
            $nom_latin = htmlspecialchars($_POST['nom_latin']);
            $taille = intval(filter_var($_POST['taille'], FILTER_SANITIZE_NUMBER_INT));
            $poids = intval(filter_var($_POST['poids'], FILTER_SANITIZE_NUMBER_INT));
            $id_classe = intval(htmlspecialchars($_POST['id_classe']));
            $id_ordre = intval(htmlspecialchars($_POST['id_ordre']));
            $id_famille = intval(htmlspecialchars($_POST['id_famille']));
            $id_espece = intval(htmlspecialchars($_POST['id_espece']));
            $id_categorie = intval(htmlspecialchars($_POST['id_categorie']));
            $descriptif = htmlspecialchars($_POST['descriptif']);

            // filtre et dowload le fichier photo
            if (isset($_FILES["photo"])){ // vérifie que l'utilisateur a bien transmis son fichier 

                // Récupere les informations du fichiers
                $tmpName = $_FILES["photo"]['tmp_name']; 
                $nameImage = $_FILES["photo"]["name"];
                $type = $_FILES["photo"]["type"];
                $error = $_FILES["photo"]["error"];
                $size = $_FILES["photo"]["size"];

                // separe la chaine de caractere $name a chaque fois qu'il a un "."
                $tabExtension = explode('.', $nameImage);               
                // Prend le dernier element de $tabExtension et le renvoie en minuscule
                $extension = strtolower(end($tabExtension));                
                // Introduit une variable ayant pour valeur un int
                $tailleMax = 3000000;                
                //Tableau des extensions qu'on autorise 
                $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];

                if(in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0 ){ // vérifie que $extension soit compris dans $extensionAutorisees et que la taille du fichier soit <= a la valeur de $tailleMax et que le fichier ne renvoie aucune erreure

                    // génere un nom unique ex: 5f586bf96dcd38.73540086
                    // $uniqueName = uniqid('', true);
                    $uniqueName = $nom_courant;
                    // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                    $fileName = $uniqueName.'.'.$extension;
                        
                    //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
                    if ($id_categorie == 1){
                        move_uploaded_file($tmpName, 'public/img/Arbre/'.$fileName);
                    } elseif ($id_categorie == 2){
                        move_uploaded_file($tmpName, 'public/img/plante/'.$fileName);
                    } elseif ($id_categorie == 3){
                        move_uploaded_file($tmpName, 'public/img/Animaux/'.$fileName);
                    }
                }


            } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                
                    // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
            
            } elseif ($size > $tailleMax) { // sinon 
            
                    // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
            }

            if (isset($fileName) && $id_categorie == 1) {
                    $photo = "public/img/Arbre/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
            } elseif (isset($fileName) && $id_categorie == 2) {
                    $photo = "public/img/plante/".$fileName;
            } elseif (isset($fileName) && $id_categorie == 3) {
                    $photo = "public/img/Animaux".$fileName;
            }
        }

    }
}
