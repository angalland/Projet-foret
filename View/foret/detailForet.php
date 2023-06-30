<?php
ob_start();?>

<article class="articleDetailForet">
    <?php foreach ($requete as $foret){?>
        <h1><?=$foret['nom_foret']?></h1>
        <p><?=$foret['descriptif']?></p>
        <img class="imgDetailForet" src="<?=$foret['photo']?>"/><?php
    }?>
</article>

<!-- carte randonnee -->
<div id="map"></div>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";