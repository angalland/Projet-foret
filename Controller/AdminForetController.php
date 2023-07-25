<?php

namespace Controller;
use Model\Connect;

class AdminForetController {

    // view add foret
    public function viewAddForet() {
        require "view/foret/ajouterForet.php";
    }

    // ajouter une foret a la bbd 
    public function addForet() {
        // verifie qu'on a bien appuyer sur ajouter
        if (isset($_POST['submitAddForet'])){
            
            // créer un tableau de $_SESSION["errors"] qui servira a traiter tous les erreures
            $_SESSION["messageAlert"] = [];

            // filtre les données envoyées
            $nom_foret = htmlspecialchars($_POST['nom_foret']);
            $ville = htmlspecialchars($_POST['ville']);
            $code_postal = htmlspecialchars($_POST['code_postal']);
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

                        // verifie que le nom de la foret n'est pas déja utilisé
                        $pdo = Connect::seConnecter();
                        $requeteNomForet = $pdo->prepare("
                            SELECT nom_foret
                            FROM foret
                            WHERE nom_foret = :nom_foret
                        ");
                        $requeteNomForet->bindparam("nom_foret", $nom_foret);
                        $requeteNomForet->execute();
                        $existeNomForet = $requeteNomForet->fetch(\PDO::FETCH_ASSOC);

                        // si il est deja utilisé renvoie une erreure
                        if ($existeNomForet){
                            $_SESSION['messageAlert'][]= "Le nom de cette fôret est déjà utilisé, veuillez mettre un autre nom";
                        } else {
                            // sinon on crée uniqueName
                            $uniqueName = $nom_foret;
                            // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                            $fileName = $uniqueName.'.'.$extension;
                            
                            //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
                            move_uploaded_file($tmpName, 'public/img/forêt/'.$fileName);
                        }


                    } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                            
                        // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                        $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
                        
                    } elseif ($size > $tailleMax) { // sinon 
                        
                        // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                        $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    }

                    if (isset($fileName)) {
                    $photo = "public/img/forêt/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
                    }
            }
            
            if (isset($nom_foret) && !empty($nom_foret) && isset($ville) && !empty($ville) && isset($code_postal) && !empty($code_postal) && isset($photo) && !empty($photo) && isset($descriptif) && !empty($descriptif)){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    INSERT INTO foret
                    (nom_foret, ville, code_postal, photo, descriptif)
                    VALUES (:nom_foret,
                            :ville,
                            :code_postal,
                            :photo,
                            :descriptif)
                ");
                $requete->bindparam("nom_foret", $nom_foret);
                $requete->bindparam("ville", $ville);
                $requete->bindparam("code_postal", $code_postal);
                $requete->bindparam("photo", $photo);
                $requete->bindparam("descriptif", $descriptif);
                $requete->execute();

                $_SESSION['messageSucces'] = "Votre forêt a bien été ajouté";

            } else {
                $_SESSION['messageAlert'][] = "Données incorrectes !";
                require "view/foret/ajouterForet.php";
            }
            require "view/foret/ajouterForet.php";
        }   
    }

    // page modifier une foret pour choisir la foret
    public function viewUpdateForet() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM foret        
        ");
        $requete->execute();
        require "view/foret/modifierForet.php";
    }

    // page pour modifier la foret choisit
    public function viewUpdateForetById() {
        if (isset($_POST['submitUpdateForet'])){

            $id_foret = intval(htmlspecialchars($_POST['foret']));

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                SELECT *
                FROM foret 
                WHERE id_foret = :id_foret       
            ");
            $requete->bindparam("id_foret", $id_foret);
            $requete->execute();

            require "view/foret/modifierForetParId.php";
        }
    }

    // update une foret
    public function updateForet($id) {
        // verifie que le bouton modifier est bien été appuyer
        if (isset($_POST['submitUpdateForet'])){
            // filtre les données
            $id_foret = filter_var($id);
            $nom_foret = htmlspecialchars($_POST['nom_foret']);
            $ville = htmlspecialchars($_POST['ville']);
            $code_postal = htmlspecialchars($_POST['code_postal']);
            $descriptif = htmlspecialchars($_POST['descriptif']);
            $anciennePhoto = htmlspecialchars($_POST['anciennePhoto']);

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
                        $requeteNomForet = $pdo->prepare("
                            SELECT nom_foret
                            FROM foret
                            WHERE nom_foret = :nom_foret
                        ");
                        $requeteNomForet->bindparam("nom_foret", $nom_foret);
                        $requeteNomForet->execute();
                        $existeNomForet = $requeteNomForet->fetch(\PDO::FETCH_ASSOC);

                        // si il est deja utilisé renvoie une erreure
                        if ($existeNomForet){
                            $_SESSION['messageAlert'][]= "Le nom de cette fôret est déjà utilisé, veuillez mettre un autre nom";
                        } else {
                            // sinon on crée uniqueName
                            $uniqueName = $nom_foret;
                            // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                            $fileName = $uniqueName.'.'.$extension;
                            
                            //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
                            move_uploaded_file($tmpName, 'public/img/forêt/'.$fileName);
                        }


                    } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                            
                        // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                        $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
                        
                    } elseif ($size > $tailleMax) { // sinon 
                        
                        // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                        $_SESSION['messageAlert'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    }

                    if (isset($fileName)) {
                    $photo = "public/img/forêt/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
                    }
            }
        }
    }
}