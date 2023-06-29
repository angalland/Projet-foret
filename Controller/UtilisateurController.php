<?php

namespace Controller;
use Model\Connect;

class UtilisateurController {
    // afficher la page home
    public function viewAccueille() {
        require "view/utilisateur/accueille.php";
    }
}