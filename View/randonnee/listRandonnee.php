<?php
ob_start();?>
<?php
        // boucle pour lire la table randonnee
        foreach ($requeteRandonnee as $randonnee){
            if ($randonnee['id_randonnee'] == 1){
                $longitude1 = $randonnee['longitude'];
                $lattitude1 = $randonnee['lattitude'];
            } elseif ($randonnee['id_randonnee'] == 2){
                $longitude2 = $randonnee['longitude'];
                $lattitude2 = $randonnee['lattitude'];
            }
        }?>
            <div id="map"></div>
                <script>
                    // initialisation de la carte leaflet et du zoom
                    var map = L.map('map').setView([<?=$longitude1?>, <?=$lattitude1?>], 14);
                    // gestion des tuiles
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);
                    // marker sur la carte
                    var marker = L.marker([<?=$longitude1?>, <?=$lattitude1?>]).addTo(map);
                    // popup sur le marker
                    marker.bindPopup("<?=$randonnee['nom_randonnee']?>").openPopup();
                    // affiche la longitude et la latitude du point sur lequel ou on clique
                    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                    var osmAttrib='Map data © OpenStreetMap contributors';
                    var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
                    map.addLayer(osm);
                    map.on('click',clicSurCarte);
                    function clicSurCarte(event){
                        var latlong=event.latlng
                        alert("Longitude - Latitude : "+latlong);
                    }
                </script>

            <div id="map"></div>
                <script>
                    // initialisation de la carte leaflet et du zoom
                    var map1 = L.map('map').setView([<?=$longitude2?>, <?=$lattitude2?>], 14);
                    // gestion des tuiles
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map1);
                    // marker sur la carte
                    var marker = L.marker([<?=$longitude2?>, <?=$lattitude2?>]).addTo(map1);
                    // popup sur le marker
                    marker.bindPopup("<?=$randonnee['nom_randonnee']?>").openPopup();
                    // affiche la longitude et la latitude du point sur lequel ou on clique
                    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                    var osmAttrib='Map data © OpenStreetMap contributors';
                    var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
                    map1.addLayer(osm);
                    map1.on('click',clicSurCarte);
                    function clicSurCarte(event){
                        var latlong=event.latlng
                        alert("Longitude - Latitude : "+latlong);
                    }
                </script>
<?php
$titre = 'Liste des randonnées';
$contenu = ob_get_clean();

require "view/template.php";