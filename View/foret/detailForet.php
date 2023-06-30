<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $foret){?>
            <h1><?=$foret['nom_foret']?></h1>
            <p><?=$foret['descriptif']?></p>
            <img class="imgDetailForet" src="<?=$foret['photo']?>"/><?php
        }?>
    </article>

    <!-- carte randonnee -->
    <h2 id="h2detailForet">La randonnée incontournable</h2>
    <div id="map"></div>
</div>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";