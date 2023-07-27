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

                        // verifie que le nom de la foret n'est pas déja utilisé
                        $pdo = Connect::seConnecter();
                        $requeteNomCourant = $pdo->prepare("
                            SELECT nom_courant
                            FROM etre_vivant
                            WHERE nom_courant = :nom_courant
                        ");
                        $requeteNomCourant->bindparam("nom_courant", $nom_courant);
                        $requeteNomCourant->execute();
                        $existeNomCourant = $requeteNomCourant->fetch(\PDO::FETCH_ASSOC);

                        // si il est deja utilisé renvoie une erreure
                        if ($existeNomCourant){
                            $_SESSION['messageAlert'][]= "Le nom de cette être-vivant est déjà utilisé, veuillez mettre un autre nom";
                            header("Location:index.php?action=viewAddEtreVivant");
                            die;
                        } else {
                            // sinon on crée uniqueName
                            $uniqueName = $nom_courant;
                            // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                            $fileName = $uniqueName.'.'.$extension;
                        }
                        
                    //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)                    
                    if (isset($fileName) && $id_categorie == 1){
                        move_uploaded_file($tmpName, 'public/img/Arbre/'.$fileName);
                    } elseif (isset($fileName) && $id_categorie == 2){
                        move_uploaded_file($tmpName, 'public/img/plante/'.$fileName);
                    } elseif (isset($fileName) && $id_categorie == 3){
                        move_uploaded_file($tmpName, 'public/img/Animaux/'.$fileName);
                    }
                }


            } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                
                    // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            } elseif ($size > $tailleMax) { // sinon 
            
                    // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            }

            if (isset($fileName) && $id_categorie == 1) {
                    $photo = "public/img/Arbre/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
            } elseif (isset($fileName) && $id_categorie == 2) {
                    $photo = "public/img/plante/".$fileName;
            } elseif (isset($fileName) && $id_categorie == 3) {
                    $photo = "public/img/Animaux/".$fileName;
            }

            // filtre et dowload le fichier photo_repartition
            if (isset($_FILES["photo_repartition"])){ // vérifie que l'utilisateur a bien transmis son fichier 

                // Récupere les informations du fichiers
                $tmpName = $_FILES["photo_repartition"]['tmp_name']; 
                $nameImage = $_FILES["photo_repartition"]["name"];
                $type = $_FILES["photo_repartition"]["type"];
                $error = $_FILES["photo_repartition"]["error"];
                $size = $_FILES["photo_repartition"]["size"];

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
                    $fileName = $uniqueName.'_repartition.'.$extension;
                        
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
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            } elseif ($size > $tailleMax) { // sinon 
            
                    // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            }

            if (isset($fileName) && $id_categorie == 1) {
                    $photo_repartition = "public/img/Arbre/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
            } elseif (isset($fileName) && $id_categorie == 2) {
                    $photo_repartition = "public/img/plante/".$fileName;
            } elseif (isset($fileName) && $id_categorie == 3) {
                    $photo_repartition = "public/img/Animaux/".$fileName;
            }

            if ($taille == 0){
                $taille = null;
            }

            if ($poids == 0){
                $poids = null;
            }

            if (isset($nom_courant) && !empty($nom_courant) && isset($nom_latin) && !empty($nom_latin) && isset($photo) && !empty($photo) && isset($photo_repartition) && !empty($photo_repartition) && isset($id_classe) && !empty($id_classe) && isset($id_ordre) &&!empty($id_ordre) && isset($id_famille) && !empty($id_famille) && isset($id_espece) && !empty($id_espece) && isset($id_categorie) && !empty($id_categorie) && isset($descriptif) && !empty($descriptif)){

                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO etre_vivant
                    (nom_courant, nom_latin, taille, poids, photo, photo_repartition, id_classe, id_ordre, id_famille, id_espece, id_categorie, descriptif)
                    VALUES (:nom_courant,
                            :nom_latin,
                            :taille,
                            :poids,
                            :photo,
                            :photo_repartition,
                            :id_classe,
                            :id_ordre,
                            :id_famille,
                            :id_espece,
                            :id_categorie,
                            :descriptif)
                ");
                $requete->bindparam("nom_courant", $nom_courant);
                $requete->bindparam("nom_latin", $nom_latin);
                $requete->bindparam("taille", $taille);
                $requete->bindparam("poids", $poids);
                $requete->bindparam("photo", $photo);
                $requete->bindparam("photo_repartition", $photo_repartition);
                $requete->bindparam("id_classe", $id_classe);
                $requete->bindparam("id_ordre", $id_ordre);
                $requete->bindparam("id_famille", $id_famille);
                $requete->bindparam("id_espece", $id_espece);
                $requete->bindparam("id_categorie", $id_categorie);
                $requete->bindparam("descriptif", $descriptif);
                $requete->execute();

                $_SESSION['messageSucces'] = "Votre être-vivant a bien été ajouté";
            } else {
                $_SESSION['messageAlert'][] = "Données incorrectes !";
                require "view/etre_vivant/ajouterEtreVivant.php";
            }
            require "view/etre_vivant/ajouterEtreVivant.php";         
        }
    }

    // Affiche la page modifier ou supprimer un etre vivant
    public function viewUpdateEtreVivant() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM etre_vivant
        ");
        $requete->execute();
        require "view/etre_vivant/modifierSupprimerEtreVivant.php";
    }

    // affiche le formulaire de modification d'un etre-vivant par id
    public function viewUpdateEtreVivantById() {
        if (isset($_POST['submitUpdateEtreVivant'])) {
            $id_etre_vivant = intval(htmlspecialchars($_POST['etre_vivant']));

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                SELECT *
                FROM etre_vivant
                INNER JOIN classe
                    ON etre_vivant.id_classe = classe.id_classe
                WHERE id_etre_vivant = :id_etre_vivant
            ");
            $requete->bindparam("id_etre_vivant", $id_etre_vivant);
            $requete->execute();

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

            require "view/etre_vivant/modifierSupprimerEtreVivantParId.php";
        }
    }

    // modifier ou supprimer un etre-vivant
    public function updateDeleteEtreVivant($id) {
        if (isset($_POST['submitUpdateEtreVivant'])){

            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            $id_etre_vivant = intval(htmlspecialchars($id));
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

            $anciennePhoto = htmlspecialchars($_POST['anciennePhoto']);
            $anciennePhotoRepartition = htmlspecialchars($_POST['anciennePhotoRepartition']);

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

                        // verifie que le nom de la foret n'est pas déja utilisé
                        $pdo = Connect::seConnecter();
                        $requeteNomCourant = $pdo->prepare("
                            SELECT nom_courant
                            FROM etre_vivant
                            WHERE nom_courant = :nom_courant
                        ");
                        $requeteNomCourant->bindparam("nom_courant", $nom_courant);
                        $requeteNomCourant->execute();
                        $existeNomCourant = $requeteNomCourant->fetch(\PDO::FETCH_ASSOC);

                        // si il est deja utilisé renvoie une erreure
                        if ($existeNomCourant){
                            $_SESSION['messageAlert'][]= "Le nom de cette être-vivant est déjà utilisé, veuillez mettre un autre nom";
                            header("Location:index.php?action=viewAddEtreVivant");
                            die;
                        } else {
                            // sinon on crée uniqueName
                            $uniqueName = $nom_courant;
                            // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                            $fileName = $uniqueName.'.'.$extension;
                        }
                        
                    //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)                    
                    if (isset($fileName) && $id_categorie == 1){
                        move_uploaded_file($tmpName, 'public/img/Arbre/'.$fileName);
                    } elseif (isset($fileName) && $id_categorie == 2){
                        move_uploaded_file($tmpName, 'public/img/plante/'.$fileName);
                    } elseif (isset($fileName) && $id_categorie == 3){
                        move_uploaded_file($tmpName, 'public/img/Animaux/'.$fileName);
                    }
                }


            } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                
                    // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            } elseif ($size > $tailleMax) { // sinon 
            
                    // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            }

            if (isset($fileName) && $id_categorie == 1) {
                    $photo = "public/img/Arbre/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
            } elseif (isset($fileName) && $id_categorie == 2) {
                    $photo = "public/img/plante/".$fileName;
            } elseif (isset($fileName) && $id_categorie == 3) {
                    $photo = "public/img/Animaux/".$fileName;
            }

            // filtre et dowload le fichier photo_repartition
            if (isset($_FILES["photo_repartition"])){ // vérifie que l'utilisateur a bien transmis son fichier 

                // Récupere les informations du fichiers
                $tmpName = $_FILES["photo_repartition"]['tmp_name']; 
                $nameImage = $_FILES["photo_repartition"]["name"];
                $type = $_FILES["photo_repartition"]["type"];
                $error = $_FILES["photo_repartition"]["error"];
                $size = $_FILES["photo_repartition"]["size"];

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
                    $fileName = $uniqueName.'_repartition.'.$extension;
                        
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
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            } elseif ($size > $tailleMax) { // sinon 
            
                    // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                    $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    header("Location:index.php?action=viewAddEtreVivant");
                    die;
            }

            if (isset($fileName) && $id_categorie == 1) {
                    $photo_repartition = "public/img/Arbre/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
            } elseif (isset($fileName) && $id_categorie == 2) {
                    $photo_repartition = "public/img/plante/".$fileName;
            } elseif (isset($fileName) && $id_categorie == 3) {
                    $photo_repartition = "public/img/Animaux/".$fileName;
            }

            if ($taille == 0){
                $taille = null;
            }

            if ($poids == 0){
                $poids = null;
            }

            if (isset($nom_courant) && !empty($nom_courant) && isset($nom_latin) && !empty($nom_latin) && isset($photo) && !empty($photo) && isset($photo_repartition) && !empty($photo_repartition) && isset($id_classe) && !empty($id_classe) && isset($id_ordre) &&!empty($id_ordre) && isset($id_famille) && !empty($id_famille) && isset($id_espece) && !empty($id_espece) && isset($id_categorie) && !empty($id_categorie) && isset($descriptif) && !empty($descriptif)){

                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    UPDATE etre_vivant
                    SET nom_courant = :nom_courant,
                        nom_latin = :nom_latin,
                        taille = :taille,
                        poids = :poids,
                        photo = :photo,
                        photo_repartition = :photo_repartition,
                        id_classe = :id_classe,
                        id_ordre = :id_ordre,
                        id_famille = :id_famille,
                        id_espece = :id_espece,
                        id_categorie = :id_categorie,
                        descriptif = :descriptif
                    WHERE id_etre_vivant = :id_etre_vivant
                ");
                $requete->bindparam("nom_courant", $nom_courant);
                $requete->bindparam("nom_latin", $nom_latin);
                $requete->bindparam("taille", $taille);
                $requete->bindparam("poids", $poids);
                $requete->bindparam("photo", $photo);
                $requete->bindparam("photo_repartition", $photo_repartition);
                $requete->bindparam("id_classe", $id_classe);
                $requete->bindparam("id_ordre", $id_ordre);
                $requete->bindparam("id_famille", $id_famille);
                $requete->bindparam("id_espece", $id_espece);
                $requete->bindparam("id_categorie", $id_categorie);
                $requete->bindparam("descriptif", $descriptif);
                $requete->bindparam("id_etre_vivant", $id_etre_vivant);
                $requete->execute();

                unlink($anciennePhoto);
                unlink($anciennePhotoRepartition);

                $_SESSION['messageSucces'] = "Votre être-vivant a bien été modifié";

                header("Location:index.php?action=viewUpdateEtreVivant");
                die;

            } else {
                $_SESSION['messageAlert'][] = "Données incorrectes !";
                header("Location:index.php?action=viewUpdateEtreVivant");
                die;
            }        
        }
        
    }
}
