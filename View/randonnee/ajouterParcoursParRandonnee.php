<?php
ob_start();?>

<form action="index.php?action=addParcours" method="POST" class="formAddRandonnee">

    <h3 class="formH3 addH3Foret">Ajouter un parcours</h3>

    <div id="map" style="width:50%;height:400px;"></div>
        <script>
            // initialisation de la carte leaflet et du zoom
            var map = L.map('map').setView([48.581647, 7.750522], 7);

            // gestion des tuiles
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // trace le chemin sur la carte
            var latlngs = [
                <?php 
            foreach ($requetePointRandonnee as $pointRandonnee){?>
                [<?=$pointRandonnee['longitude']?>, <?=$pointRandonnee['lattitude']?>],
                <?php
            }?>
            ]
            
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
            
            map.fitBounds(polyline.getBounds());
            
            // marker sur la carte
            // marker du départ
            <?php
            foreach ($requetePoint as $point){?>
            var marker1 = L.marker([<?=$point['longitude']?>, <?=$point['lattitude']?>]).addTo(map);
            // popup sur le marker
            marker1.bindPopup("Départ de la randonnée").openPopup();
            <?php
            }?>

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

    <div class="divAddRandonnee">
        <div class="addPointRandonnee">
            <h4 class="formH3 addH3Foret">Ajouter un point de départ</h4>
            <label for="point_depart" class="addLabel">Longitude : </label>
            <input type="number" name="point_depart_longitude" id="point_depart" class="inputPointRandonnee" placeholder="Exemple : 48.789855" step="0.000001">
            <label for="point_depart" class="addLabel">Lattitude : </label>
            <input type="number" name="point_depart_lattitude" id="point_depart" class="inputPointRandonnee" placeholder="Exemple : 7.568952" step="0.000001">
            <input class="buttonPointRandonnee" type="submit" name="submitAddParcoursPointDepart" value='Ajouter le point de départ'>
        </div>
        
        <div class="addPointRandonnee">
            <h4 class="formH3 addH3Foret">Ajouter un point</h4>
            <label for="point" class="addLabel">Longitude : </label>
            <input type="number" name="point_longitude" id="point" class="inputPointRandonnee" placeholder="Exemple : 48.789855" step="0.000001">
            <label for="point" class="addLabel">Lattitude : </label>
            <input type="number" name="point_lattitude" id="point" class="inputPointRandonnee" placeholder="Exemple : 7.568952" step="0.000001">
            <input class="buttonPointRandonnee" type="submit" name="submitAddParcoursPoint" value='Ajouter un point'>
        </div>

        <div class="addPointRandonnee">
            <h4 class="formH3 addH3Foret">Ajouter un point d'arrivée</h4>
            <label for="point_arrivee" class="addLabel">Longitude : </label>
            <input type="text" name="point_arrivee_longitude" id="point_arrivee" class="inputPointRandonnee" placeholder="Exemple : 48.789855" step="0.000001">
            <label for="point_arrivee" class="addLabel">Lattitude : </label>
            <input type="text" name="point_arrivee_lattitude" id="point_arrivee" class="inputPointRandonnee" placeholder="Exemple : 7.365241" step="0.000001">
            <input class="buttonPointRandonnee" type="submit" name="submitAddParcoursPointArrivee" value="Ajouter un point d'arrivée">
        </div>
    </div>
</form>
<?php
$titre = 'ajouter parcours';
$contenu = ob_get_clean();

require "view/template.php";