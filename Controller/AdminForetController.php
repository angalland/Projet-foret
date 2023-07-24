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
            
            // filtre les données envoyées
            $nom_foret = htmlspecialchars($_POST['nom_foret']);
            
        }   

    }
}