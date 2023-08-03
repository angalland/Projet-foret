<?php
ob_start();?>
<div>
<?php
foreach ($requetePointDepart as $depart){
        foreach($requetePointArrivee as $arrivee){?>        
    <div id="map" style="width:100%;height:400px;margin:10px 0 0 0;"></div>
        
        <script>
            // initialisation de la carte leaflet et du zoom
            var map = L.map('map').setView([<?=$depart['longitude']?>, <?=$depart['lattitude']?>], 7);

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
                document.getElementById("coordonnee").innerHTML = latlong;
            }

            // trace le chemin sur la carte
            var latlngs =[
                <?php
                foreach ($_SESSION['ligne'] as $point){?>
                [<?=$point['longitude']?>, <?=$point['lattitude']?>],
                <?php
                }?>
            ]
            
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
            
            map.fitBounds(polyline.getBounds());
            
            // marker sur la carte

            // marker de tous les points
            <?php           
            for ($i=0;$i<=array_key_last($_SESSION['ligne']);$i++){?>
                var marker<?=$_SESSION['ligne'][$i]['id_point']?>= L.marker([<?=$_SESSION['ligne'][$i]['longitude']?>, <?=$_SESSION['ligne'][$i]['lattitude']?>]).addTo(map);
            <?php
            }?>

        </script>

        <p id="coordonnee"></p>
        <?php
        }
    }?>

    <form action="index.php?action=addParcours" method="POST" class="formAddRandonnee">
    
        <div class="addPointRandonnee">
            <h4 class="formH3 addH3Foret">Supprimer un point du parcours</h4>
            <label for="point_depart" class="addLabel">Longitude : </label>
            <input type="number" name="point_depart_longitude" id="point_depart" class="inputPointRandonnee" placeholder="Exemple : 48.789855" step="0.000001">
            <label for="point_depart" class="addLabel">Lattitude : </label>
            <input type="number" name="point_depart_lattitude" id="point_depart" class="inputPointRandonnee" placeholder="Exemple : 7.568952" step="0.000001">
            <input class="buttonPointRandonnee" type="submit" name="submitAddParcoursPointDepart" value='Supprimer un point du parcours'>
        </div>

        <input class="buttonPointRandonnee" type="submit" name="submitAddParcoursPointDepart" value='Supprimer tout le parcours'>

    </form>
</div>
<?php
$titre = 'Supprimer parcours';
$contenu = ob_get_clean();

require "view/template.php";