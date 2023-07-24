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
            $_SESSION["errors"] = [];

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
                        ");
                        $requeteNomForet->execute();
                        $existeNomForet = $requeteNomForet->fetch(\PDO::FETCH_ASSOC);
                        var_dump($existeNomForet);
                        exit();
                        if ($existeNomForet){
                            $_SESSION['errors'][]= "Le nom de cette fôret est déjà utilisé, veuillez mettre un autre nom";
                        } else {
                            $uniqueName = $nom_foret;
                        }

                        // on ajoute $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                        $fileName = $uniqueName.'.'.$extension;
                        
                        //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
                        move_uploaded_file($tmpName, 'public/img/forêt/'.$fileName);

                    } elseif (in_array($extension, $extensionAutorisees) == false) { // sinon
                            
                        // envoie un message d'alerte si la premiere condition n'est pas respecté et le fichier ne sera pas transmis
                        $_SESSION['errors'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers au format jpg, jpeg, gif ou png";
                        
                    } elseif ($size > $tailleMax) { // sinon 
                        
                        // envoie un message d'alerte si la taille du fichier dépasse la taille autorisé
                        $_SESSION['errors'] [] = "Le fichier n'a pas été ajouté, vous devez transmettre des fichiers de moins de 3 méga";
                    }

                    if (isset($fileName)) {
                    $affiche = "public/img/forêt/".$fileName; // crée une variable qui = au chemin d'acces du fichier dans le dossier upload
                    var_dump($affiche);
                    }
            }        
        }   

    }
}