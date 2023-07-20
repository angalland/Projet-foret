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
           
            <?php
        }?>
    </script><?php
    }?>

    <article  class="commentaire">
        <h2>Commentaire :</h2>
        <?php
        foreach ($requeteCommentaire as $commentaire){?>
            <div id="commentaireModification">
                <p><?= $commentaire['pseudo']?> : <?= $commentaire['commentaire']?></p><?php
                if ($commentaire['id_utilisateur'] == $_SESSION['user']['id_utilisateur']){?>
                    <button class="modifier button"><a href="index.php?action=connexion">Modifier</a></button>
                    <button class="supprimer button"><a href="index.php?action=connexion">Supprimer</a></button><?php
                }?>
            </div><?php
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