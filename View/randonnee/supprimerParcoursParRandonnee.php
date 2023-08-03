<?php
ob_start();

//     for ($i=0;$i<=array_key_last($_SESSION['ligne']);$i++){
//         var_dump($_SESSION['ligne'][$i]['longitude']);
//     }

// die();

foreach ($requetePointDepart as $depart){
        foreach($requetePointArrivee as $arrivee){?>            ?>
 <div id="map" style="width:50%;height:400px;"></div>
        
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
            // marker de l'arrivée
                var marker2 = L.marker([<?=$arrivee['longitude']?>, <?=$arrivee['lattitude']?>]).addTo(map);
                marker2.bindPopup("Arrivée").openPopup();

            // marker de tous les points
            <?php           
            for ($i=0;$i<=array_key_last($_SESSION['ligne']);$i++){?>
                var marker<?=$_SESSION['ligne'][$i]['id_point']?>= L.marker([<?=$_SESSION['ligne'][$i]['longitude']?>, <?=$_SESSION['ligne'][$i]['lattitude']?>]).addTo(map);
            <?php
            }?>
            // marker du départ
            var marker1 = L.marker([<?=$depart['longitude']?>, <?=$depart['lattitude']?>]).addTo(map);
            // popup sur le marker
            marker1.bindPopup("Départ de la randonnée").openPopup();
        </script>

        <p id="coordonnee"></p>
        <?php
        }
    }


$titre = 'Supprimer parcours';
$contenu = ob_get_clean();

require "view/template.php";