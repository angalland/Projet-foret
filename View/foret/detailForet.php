<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $foret){
            $id_foret = $foret['id_foret']?>
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
            var marker1 = L.marker([<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>]).addTo(map);
            // var marker2 = L.marker([48.722538, 7.336367]).addTo(map);

            // ligne entre 2 point test 1
            // var latlngs = Array();
            // latlngs.push(marker1.getLatLng());
            // latlngs.push(marker2.getLatLng());
            // var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
            // map.fitBounds(polyline.getBounds());

            // ligne entre plusieurs point test 1
            var marker2 = [<?=$randonnee['longitude']?>, <?=$randonnee['lattitude']?>];
            var latlngs2 = [
                [48.741805, 7.361058],
                [48.741027, 7.359784],
                [48.740931, 7.359715],
                [48.740714, 7.35935],
                [48.739826, 7.358927],
                [48.739691, 7.35888],
                [48.739311, 7.358958],
                [48.739193, 7.358953],
                [48.738752, 7.358851],
                [48.738306, 7.358781],
                [48.737921, 7.358725],
                [48.737859, 7.358768],
                [48.73782, 7.358653],
                [48.737785, 7.3581],
                [48.737739, 7.357939],
                [48.737585, 7.357711],
                [48.737441, 7.357649],
                [48.737323, 7.357671],
                [48.736801, 7.358229],
                [48.736426, 7.35853],
                [48.736099, 7.358599],
                [48.735913, 7.358537],
                [48.735722, 7.358371],
                [48.735379, 7.357907],
                [48.735025, 7.357188],
                [48.734002, 7.354204],
                [48.733638, 7.352565],
                [48.733613, 7.350084],
                [48.733748, 7.34929],
                [48.73388, 7.348921],
                [48.733925, 7.348653],
                [48.733893, 7.348406],
                [48.733815, 7.348157],
                [48.73358, 7.347849],
                [48.733466, 7.348039],
                [48.732966, 7.347271],
                [48.73266, 7.346829],
                [48.73194, 7.34623],
                [48.731807, 7.346105],
                [48.731315, 7.345373],
                [48.73119, 7.34514],
                [48.730528, 7.344572],
                [48.730105, 7.344072],
                [48.729038, 7.343337],
                [48.728773, 7.343149],
                [48.72861, 7.343017],
                [48.728109, 7.34239],
                [48.728111, 7.342385],
                [48.727855, 7.341964],
                [48.72751, 7.34146],
                [48.727361, 7.341321],
                [48.727296, 7.341138],
                [48.727158, 7.340827],
                [48.727044, 7.340472],
                [48.726839, 7.340041],
                [48.726499, 7.339625],
                [48.726398, 7.339644],
                [48.726374, 7.339767],
                [48.726393, 7.33999],
                [48.726391, 7.339979],
                [48.72654, 7.340387],
                [48.726547, 7.340486],
                [48.726522, 7.340596],
                [48.726395, 7.340612],
                [48.726305, 7.340545],
                [48.726103, 7.340352],
                [48.725516, 7.339711],
                [48.725181, 7.339363],
                marker2
            ];

            var polyline = L.polyline(latlngs2, {color: 'red'}).addTo(map);

            map.fitBounds(polyline.getBounds());
            // popup sur le marker
            marker1.bindPopup("<?=$randonnee['nom_randonnee']?>").openPopup();
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
           
            <?php
        }?>
    </script><?php
    }?>

    <article  class="commentaire">
        <h2>Commentaire :</h2>
        <?php
        foreach ($requeteCommentaire as $commentaire){
            $date = $commentaire['date'];
            $dt = new DateTime($date);
            ?>
            <div id="commentaireModification">
                <p><?= $commentaire['pseudo']?> <?=$dt->format("d/m/Y H:i")?> : <?= $commentaire['commentaire']?></p><?php
                if (isset($_SESSION['user'])){
                    if ($commentaire['id_utilisateur'] == $_SESSION['user']['id_utilisateur']){?>
                        <button class="modifier button">Modifier</button>
                        <button class="supprimer button"><a href="index.php?action=supprimerCommentaireForet&id=<?=$commentaire['id_commentaire_foret']?>&id_foret=<?=$commentaire['id_foret']?>">Supprimer</a></button>
                </div>

                        <div class="formulaireModiffier">
                            <form action="index.php?action=modifierCommentaireForet&id=<?=$commentaire['id_commentaire_foret']?>&id_foret=<?=$commentaire['id_foret']?>" method="POST">
                                <input class="inputConnexion" type="text" name="modifierCommentaire" placeholder="<?= $commentaire['commentaire']?>"/>
                                <input class="button" type="submit" name="submit_update_commentaire" value="Modifier">
                            </form>
                        </div><?php
                    }
                }
        }

        if (isset($_SESSION['user'])){?>           
            <form action="index.php?action=posterCommentaire&id=<?=$_SESSION['user']['id_utilisateur']?>&id_foret=<?=$id_foret?>" method="POST">
                <input class="inputConnexion" type="text" name="commentaire" placeholder="Votre commentaire">
                <input class="button" type="submit" name="submit_commentaire" value="poster">
            </form><?php
        } else {?>
            <div id="commentaireConnexion">
            <p> Vous devez être connecter pour poster un commentaire</p>
            <button class="button"><a href="index.php?action=connexion">Se connecter</a></button>
            </div>
            <?php
        }?>  
    </article>
</div>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";