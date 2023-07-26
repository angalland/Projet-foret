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
        if (isset($_POST['submitAddEtreVivant'])){
            
        }
    }
}