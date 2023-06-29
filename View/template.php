<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            
            <link rel="stylesheet" href="public/css/style/style.css" />

            <title><?= $titre ?></title>
        </head>

        <body>
            <nav class="navbar">
                <a href="index.php?action=accueille" class="logo"><img src="public/logo/logoForet.jpg"/>
                <div class="nav-link">
                    <ul>
                        <li><a href="index.php?action=listForet">Forêt</a></li>
                        <li><a href="index.php?action=listArbre">Arbres</a></li>
                        <li><a href="index.php?action=listPlante">Plantes</a></li>
                        <li><a href="index.php?action=listAnimaux">Animaux</a></li>
                        <li><a href="index.php?action=listRandonnee">Randonnées</a></li>
                        <?php
                        if (isset($_SESSION['user'])){?>
                            <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
                            <li><a href="index.php?action=utilisateur">Mon Compte</a></li>
                            <?php 
                        } else {?>
                            <li><a href="index.php?action=connexion">Connexion</a></li>
                            <?php
                        }?>
                    </ul>
                </div>
            </nav>

            <header></header>
            <div><?= $contenu ?></div>
        </body>
    </html>