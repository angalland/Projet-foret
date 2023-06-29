<?php

namespace Controller;
use Model\Connect;

class ForetController {
    
    // affiche la list des foret
    public function listForet() {
        require "view/foret/listForet.php";
    }
}