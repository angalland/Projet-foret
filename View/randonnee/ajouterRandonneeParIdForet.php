<?php
ob_start();?>
<form action="" method="POST">

    <h3>Ajouter une randonnée</h3>

    <label for="nom_randonnee">Nom de la randonnee : </label>
    <input type="text" name="nom_randonnee" id="nom_randonnee">

    <label for="duree">Durée en Min : </label>
    <input type="number" name="duree" id="duree">

    <label for="difficulte">Difficulte : </label>
    <input type="number" name="difficulte" id="difficulte">


    <div id="map" style="width:400px;height:400px;margin:30px"></div>
        <script>
            // initialisation de la carte leaflet et du zoom
            var map = L.map('map').setView([48.581647, 7.750522], 7);

            // gestion des tuiles
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

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
</form>
<?php
$titre = 'ajouter une randonnée';
$contenu = ob_get_clean();

require "view/template.php";