<?php

namespace Controller;
use Model\Connect;

class UserController {

    // view connexion 
    public function connexion(){            
        require "View/utilisateur/connexion.php";
    }
}