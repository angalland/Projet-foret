<?php

namespace Controller;
use Model\Connect;

class AdminEtreVivantController {

    // affiche la page ajouter etre vivant
    public function viewAddEtreVivant(){
        require "view/etre_vivant/ajouterEtreVivant.php";
    }
}