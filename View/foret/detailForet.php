<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $foret){?>
            <h1><?=$foret['nom_foret']?></h1>
            <p><?=$foret['descriptif']?></p>
            <img class="imgDetailForet" src="<?=$foret['photo']?>"/><?php
        ?>
    </article>

    <!-- carte randonnee -->
    <h2 id="h2detailForet">La randonnée incontournable</h2>
    <div id="map"></div>
    <script>
        <?php
        // boucle pour lire la table randonnee
        foreach ($requeteRandonnee as $randonnee){?>
            // initialisation de la carte leaflet et du zoom
            var map = L.map('map').setView([<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>], 14);
            // gestion des tuiles
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            // marker sur la carte
            var marker = L.marker([<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>]).addTo(map);
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

            // On active la gestion des itinéraire
            L.Routing.control({
                geocoder: L.Control.Geocoder.nominatim(),

                router: new L.Routing.osrmv1({
                    language: "fr",
                    profil: "foot"
                })
            }).addTo(map);
            <?php
        }?>
    </script><?php
    }?>
</div>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";