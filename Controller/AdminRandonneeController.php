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

    // page pour ajouter une randonée apres avoir choisit la foret
    public function viewAddRandonneeByForet() {
        if (isset($_POST['submitAddRandonnee'])){
    
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
}