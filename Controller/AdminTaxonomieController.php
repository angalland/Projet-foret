<?php

namespace Controller;
use Model\Connect;

class AdminTaxonomieController {

    // page ajouter taxonomie
    public function viewTaxonomie(){
        
        require "view/taxonomie/ajouterTaxonomie.php";
    }
}