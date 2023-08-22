<?php
ob_start();?>
<?php
foreach ($res as $randonnee){?>
    <div class="leafletRandonne">
        <div id="<?=$randonnee['id_randonnee']?>" style="width:400px;height:400px;margin:30px"></div>

        <script>

        // initialisation de la carte leaflet et du zoom
        <?php
        foreach ($requetePointDepart as $depart){?>
        var map = L.map('<?=$randonnee['id_randonnee']?>').setView([
                <?=$depart['longitude']?>, <?=$depart['lattitude']?> 
                ], 14);
            <?php
        }?>
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
        var marker1 = L.marker([<?=$depart['longitude']?>, <?=$depart['lattitude']?>]).addTo(map);
        // marker de l'arrivée
        <?php
        foreach ($requetePointArrivee as $arrivee){?>
            var marker2 = L.marker([<?=$arrivee['longitude']?>, <?=$arrivee['lattitude']?>]).addTo(map);
            <?php
        }?>

        // popup sur le marker
        marker2.bindPopup("Arrivée").openPopup();
        marker1.bindPopup("Départ de la randonnée").openPopup();

        </script>

        <button class='buttonRandonnee'><a href="index.php?action=detailRandonne&id=<?=$randonnee['id_randonnee']?>">Détail de la <?=$randonnee['nom_randonnee']?></a></button>

    </div>
<?php
}

$titre = 'Liste des randonnées';
$contenu = ob_get_clean();

require "view/template.php";