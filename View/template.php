<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            
            <link rel="stylesheet" href="public/css/style/style.css" />
            <link rel="stylesheet" href="public/css/style/templateStyle.css" />
            <link rel="stylesheet" href="public/css/style/foretStyle.css" />
            <link rel="stylesheet" href="public/css/style/arbreStyle.css" />
            <link rel="stylesheet" href="public/css/style/formStyle.css" />

            <!-- lien leaflet -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="crossorigin=""/>

            <!-- biblioteque itinéraire -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
            <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

            <!-- script leaflet -->
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>

            <!-- script biblioteque -->
            <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
            <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

            <title><?= $titre ?></title>
        </head>

        <body>
            <div class="contenu">
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
                                <li><a href="index.php?action=connexion"><img class="logoConnexion" src="public/logo/user-regular.svg" /></a></li>
                                <?php
                            }?>
                        </ul>
                    </div>
                </nav>

                <header>
                        <form id="formRecherche" action="#" method="POST">
                            <button id="barreRecherche" type="text" name="recherche">
                                <img id="loupe_recherche" src="public/logo/loupe_recherche.svg" />
                                Recherche
                            </button>
                        </form>
                </header>
                <main><?= $contenu ?></main>
            </div>
            <footer>
                    <ul class="list-services">
                        <li><a href="#">© 2023 - Forêst compagnie</a></li>
                        <li><a href="#">Action de Forêst</a></li>
                        <li><a href="#">Nous contacter</a></li>
                        <li><a href="#">Mention légale</a></li>
                        <li><a href="#">Vos informations personnelles</a></li>
                    <ul>                           
            </footer>
            
            <script src="public/javascript/leafetJs.js"></script>
            <script src="public/javascript/main.js"></script>
        </body>
    </html>