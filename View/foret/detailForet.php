<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $foret){
            $id_foret = $foret['id_foret']?>
            <h1><?=$foret['nom_foret']?></h1>
            <p><?=$foret['descriptif']?></p>
            <img class="imgDetailForet" src="<?=$foret['photo']?>"/><?php
        }
        ?>
    </article>

    <!-- carte randonnee -->
    <h2 id="h2detailForet">La randonnée incontournable</h2>
        <div class="r">
        <?php
        // boucle pour lire la table randonnee
        foreach ($randonneeForet as $randonnee){
            // ?>
            <div class="Ra">
            <div id='map<?=$randonnee['id_randonnee']?>' style="width:350px;height:400px;margin:30px;">
                <!-- <div id=""></div> -->
            </div>
            <script>

            // initialisation de la carte leaflet et du zoom
            var map = L.map('map<?=$randonnee['id_randonnee']?>').setView([<?=$randonnee['pointDepart'][0]['longitude']?>, <?=$randonnee['pointDepart'][0]['lattitude']?>
                ], 14);

            // gestion des tuiles
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            // trace le chemin sur la carte
            var latlngs = [
                <?php 
            foreach ($randonnee['pointRandonnee'] as $pointRandonnee){?>
                [<?=$pointRandonnee['longitude']?>, <?=$pointRandonnee['lattitude']?>],
                <?php
            }?>
            ]
            
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
            
            map.fitBounds(polyline.getBounds());
            
            // marker sur la carte
            // marker du départ
            var marker1 = L.marker([<?=$randonnee['pointDepart'][0]['longitude']?>, <?=$randonnee['pointDepart'][0]['lattitude']?>]).addTo(map);
            // marker de l'arrivée
               var marker2 = L.marker([<?=$randonnee['pointArrivee'][0]['longitude']?>, <?=$randonnee['pointArrivee'][0]['lattitude']?>]).addTo(map);


            // popup sur le marker
            marker2.bindPopup("Arrivée").openPopup();
            marker1.bindPopup("Départ de la randonnée").openPopup();


            // affiche la longitude et la latitude du point sur lequel ou on clique
            // var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            // var osmAttrib='Map data © OpenStreetMap contributors';
            // var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
            // map.addLayer(osm);
            // map.on('click',clicSurCarte);
            // function clicSurCarte(event){
            //     var latlong=event.latlng
            //     alert("Longitude - Latitude : "+latlong);
            // }
            </script>

        <button class='buttonRandonnee'><a href="index.php?action=detailRandonne&id=<?=$randonnee['id_randonnee']?>">Détail de la <?=$randonnee['pointDepart'][0]['nom_randonnee']?></a></button>
        </div>
            <?php
            }?> 
    </div>

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