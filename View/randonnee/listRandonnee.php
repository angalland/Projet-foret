<?php
ob_start();?>
<?php
                foreach ($requeteRandonnee as $randonnee){?>
                <a href="index.php?action=detailRandonne&id=<?=$randonnee['id_randonnee']?>">
                    <div id="<?=$randonnee['id_randonnee']?>" style="width:400px;height:400px;margin:30px"></div>
                    <script>
                        // initialisation de la carte leaflet et du zoom
                        var map = L.map('<?=$randonnee['id_randonnee']?>').setView([<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>], 14);
                        // gestion des tuiles
                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);
                        // marker sur la carte
                        var marker = L.marker([<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>]).addTo(map);
                        // popup sur le marker
                        marker.bindPopup("<?=$randonnee['nom_randonnee']?>").openPopup();
                        var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                        var osmAttrib='Map data © OpenStreetMap contributors';
                        var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
                        map.addLayer(osm);
                        // affiche la longitude et la latitude du point sur lequel ou on clique
                        // map.on('click',clicSurCarte);
                        // function clicSurCarte(event){
                        //     var latlong=event.latlng
                        //     alert("Longitude - Latitude : "+latlong);
                        // }
                    </script>
                <button><a href="index.php?action=detailRandonne&id=<?=$randonnee['id_randonnee']?>">Détail de la <?=$randonnee['nom_randonnee']?></a></button><?php
                }


$titre = 'Liste des randonnées';
$contenu = ob_get_clean();

require "view/template.php";