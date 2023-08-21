<?php

namespace Controller;
use Model\Connect;

class RandonneeController {

    // affiche la page list des randonnées
    public function listRandonnee(){
        $pdo = Connect::seConnecter();
        $requeteRandonnee = $pdo->prepare("
            SELECT *
            FROM randonnee
        ");
        $requeteRandonnee->execute();
        $res = $requeteRandonnee->fetchAll();
        
        foreach ($res as $randonnee){
            $id_randonnee = $randonnee['id_randonnee'];
        
            $requetePointDepart = $pdo->prepare("
                    SELECT *
                    FROM point
                    INNER JOIN randonnee
                        ON point.id_randonnee = randonnee.id_randonnee
                    WHERE randonnee.id_randonnee = :id
                    AND etape = 'Départ'
            ");
            $requetePointDepart->bindparam("id", $id_randonnee);
            $requetePointDepart->execute();
                    
            $requetePointRandonnee = $pdo->prepare("
                SELECT *
                FROM point
                INNER JOIN randonnee
                    ON point.id_randonnee = randonnee.id_randonnee
                WHERE randonnee.id_randonnee = :id
            ");
            $requetePointRandonnee->bindparam("id", $id_randonnee);
            $requetePointRandonnee->execute();
                    
            $requetePointArrivee = $pdo->prepare("
                SELECT *
                FROM point
                INNER JOIN randonnee
                    ON point.id_randonnee = randonnee.id_randonnee
                WHERE randonnee.id_randonnee = :id
                AND etape = 'Arrivée'
            ");
            $requetePointArrivee->bindparam("id", $id_randonnee);
            $requetePointArrivee->execute();
        }
        require "view/randonnee/listRandonnee.php";
    }

    // affiche le detail d'une randonnee
    public function detailRandonne($id) {
        $id_randonnee = intval(htmlspecialchars($id));
        $pdo = Connect::seConnecter();
        $requeteRandonnee = $pdo->prepare("
            SELECT *
            FROM randonnee
            WHERE id_randonnee = :id_randonnee
        ");
        $requeteRandonnee->bindparam("id_randonnee", $id_randonnee);
        $requeteRandonnee->execute();

        require "view/randonnee/detailRandonnee.php";
    }
}