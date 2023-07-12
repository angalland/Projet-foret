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
}