<?php
ob_start();?>

<?php
foreach ($requetePointDepart as $depart){
        foreach($requetePointArrivee as $arrivee){?>        
    <div id="map" style="width:50%;height:400px;margin:20px;"></div>
        
        <script>
            // initialisation de la carte leaflet et du zoom
            var map = L.map('map').setView([<?=$depart['longitude']?>, <?=$depart['lattitude']?>], 14);

            // gestion des tuiles
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // affiche la longitude et la latitude du point sur lequel ou on clique
            // var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            // var osmAttrib='Map data © OpenStreetMap contributors';
            // var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
            // map.addLayer(osm);
            // map.on('click',clicSurCarte);
            // function clicSurCarte(event){
            //     var latlong=event.latlng
            //     document.getElementById("coordonnee").innerHTML = latlong;
            // }

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
                marker<?=$_SESSION['ligne'][$i]['id_point']?>.bindPopup("Long:<?=$_SESSION['ligne'][$i]['longitude']?>, lat:<?=$_SESSION['ligne'][$i]['lattitude']?>").openPopup();
            <?php
            }?>

        </script>

        <p id="coordonnee"></p>
        <?php
        }
    }?>

    <form action="index.php?action=deletePoint&id=<?=$_SESSION['id_randonnee']?>" method="POST" class="formAddRandonnee">
    
        <div class="addPointRandonnee">
            <h4 class="formH3 addH3Foret">Supprimer un point</h4>
            <label for="point_longitude" class="addLabel">Longitude : </label>
            <input type="number" name="point_longitude" id="point_longitude" class="inputPointRandonnee" placeholder="Exemple : 48.789855" step="0.000001">
            <label for="point_lattitude" class="addLabel">Lattitude : </label>
            <input type="number" name="point_lattitude" id="point_lattitude" class="inputPointRandonnee" placeholder="Exemple : 7.568952" step="0.000001">
            <input class="buttonPointRandonnee" type="submit" name="submitDeletePoint" value='Supprimer un point'>
        </div>

        <input class="buttonPointRandonnee" type="submit" name="submitDeleteAllPoint" value='Supprimer tout le parcours'>

    </form>

<?php
$titre = 'Supprimer parcours';
$contenu = ob_get_clean();

require "view/template.php";