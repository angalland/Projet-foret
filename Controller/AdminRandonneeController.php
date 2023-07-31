<?php

namespace Controller;
use Model\Connect;

class AdminRandonneeController {

    // affiche la page ajouter une randonnee
    public function viewAddRandonnee(){
        require "view/randonnee/ajouterRandonnee.php";
    }
}