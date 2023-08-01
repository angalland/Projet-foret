<?php
ob_start();?>
<form action="" method="POST" class="formAddRandonnee">

    <h3 class="formH3 addH3Foret">Ajouter une randonnée</h3>

    <div class="addDiv">
    <label for="nom_randonnee" class="addLabel">Nom de la randonnee : </label>
    <input type="text" name="nom_randonnee" id="nom_randonnee" class="inputConnexion">
    </div>

    <div class="addDiv">
    <label for="duree" class="addLabel">Durée en Min : </label>
    <input type="number" name="duree" id="duree" class="inputConnexion">
    </div>

    <div class="addDiv">
    <label for="difficulte" class="addLabel">Difficulte : </label>
    <input type="number" name="difficulte" id="difficulte" class="inputConnexion">
    </div>

    <div id="map" style="width:50%;height:400px;"></div>
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

    <div class="addButtonForet ">
        <input class="button" type="submit" name="submitAddForet" value='Ajouter'>
    </div>

</form>
<?php
$titre = 'ajouter une randonnée';
$contenu = ob_get_clean();

require "view/template.php";