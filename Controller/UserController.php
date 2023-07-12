<?php

namespace Controller;
use Model\Connect;

class UserController {

    // view connexion 
    public function connexion(){            
        require "View/utilisateur/connexion.php";
    }

    // connexion
    public function login(){

        // filtre les données envoyés par POST
        if (!empty($_POST['email']) && !empty($_POST['password']) &&!empty($_POST['pseudo'])) {
            $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
            

            // si les filtres renvoie true
            if (isset($pseudo) && isset($email) && isset($password)){

                // on cherche dans la bbd si l'email existe
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                    SELECT *
                    FROM utilisateur
                    WHERE email = :email  
                    AND pseudo = :pseudo     
                ");
                $requete->bindparam("email", $email);
                $requete->bindparam("pseudo", $pseudo);
                $requete->execute();
                $res = $requete->fetch(\PDO::FETCH_ASSOC);

                // si le pseudo et l'email existe
            if ($res) {
                // on récupère le mot de passe hash de la bbd et on le compare au mdp saisie via la fonction password_verify
                $passwordProtected = $res['password'];        
                if (password_verify($password, $passwordProtected)) {
                // si cela correspond message de succes
                    $_SESSION['messageSucces'] = 'Connexion réussi';
                    $_SESSION['user'] = $res;
                    require "View/foret/listForet.php";
                // sinon message d'erreure
                } else {
                    $_SESSION['messageAlert'] [] = 'Mot de passe incorrecte';
                    require "view/utilisateur/connexion.php";
                }
            } else {
                // si l'email n'est pas trouvé dans la base de donné message d'alert
                $_SESSION['messageAlert'] [] = 'identifiant incorrecte';
                require "view/utilisateur/connexion.php";
            }
            } else {
                $_SESSION['messageAlert'] [] = 'Identifiant incorrecte';
                require "view/utilisateur/connexion.php";
            }
        } else {
            $_SESSION['messageAlert'] [] = 'identifiant incorrecte';
            require "view/utilisateur/connexion.php"; 
        } 
    }

    // incription
    public function inscription(){

        // filtre les donnees envoyé par $_POST
        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {

            $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
            $confirmPassword = htmlspecialchars($_POST['confirmPassword'], ENT_QUOTES);

            // si les filtres sont vrai
            if (isset($pseudo) && isset($email) && isset($password) && isset($confirmPassword)) {

                // cherche dans la base de donnée si l'email est deja utilise
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                SELECT *
                FROM utilisateur
                WHERE email = :email
                OR pseudo = :pseudo
                ");
                $requete->bindparam("email", $email);
                $requete->bindparam("pseudo", $pseudo);
                $requete->execute();
                $existeEmail = $requete->fetch(\PDO::FETCH_ASSOC);

                // si $existe est vrai alors envoie un message d'erreure
                if ($existeEmail){
                    $_SESSION['messageAlert'] [] = 'Cette email ou ce pseudo est déja utilisé';
               

                // sinon verifie que les 2 champs de mot passes soient identiques
                } elseif ($password == $confirmPassword) {

                    // crypte le mot de passe pour qu'il n'apparaissent pas dans la bbd
                    $passwordProtected = password_hash($password, PASSWORD_DEFAULT);
                    // crée un nouvel utilisateur
                    $pdo = Connect::seConnecter();
                    $requete = $pdo->prepare("
                    INSERT INTO utilisateur
                    (pseudo, email, password)
                    VALUES (:pseudo,
                            :email,
                            :password)        
                    ");
                    $requete->bindparam("pseudo", $pseudo);
                    $requete->bindparam("email", $email);
                    $requete->bindparam("password", $passwordProtected);
                    $requete->execute();
        
                    $_SESSION['messageSucces'] = 'Votre inscription est réussi';
        
                } else {               
                    $_SESSION['messageAlert'] [] = 'Vos mot de passes ne sont pas identique';
                }
            } 
        }  else {
            $_SESSION['messageAlert'] [] = 'Inscription incorrecte';
        }        
            require "view/utilisateur/connexion.php";            
    }

    // affiche la page deconnexion
    public function viewLogout() {
        require "view/utilisateur/deconnexion.php";
    }

     // deconnexion
     public function logout(){
        // verifie qu'une session user est bien présente
        if (isset($_SESSION['user'])){
            // si on a appuyer sur oui
            if (!empty($_POST['deconnexion'])){
                // filtre les donné envoyé par le formulaire
                $deconnexion = htmlspecialchars($_POST['deconnexion'], ENT_QUOTES);

                // lorque le filtre a bien fonctionné 
                // on a appuyé sur oui
                if ($deconnexion == 'true') {
                    // on supprime la session user 
                    unset($_SESSION['user']);
                    // on affiche un message de déconnexion
                    $_SESSION['messageSucces'] = 'Vous avez bien été déconnecté !';
                    // on renvoie ver la page de connexion
                    require "view/utilisateur/connexion.php";

                // on a appuye sur non
                } elseif ($deconnexion == 'false') {
                    $_SESSION['deconnexion'] = 'Vous restez connecté';
                    require "view/utilisateur/deconnexion.php";
                }
            }
        } else {
            require "view/utilisateur/connexion.php";
        }
    }

}