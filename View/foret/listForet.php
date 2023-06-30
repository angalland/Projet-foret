<?php
ob_start();

foreach ($requete->fetchAll() as $foret){?>
    <article id="articleListForet">
        <img class="imgListForet" src="<?= $foret['photo']?>" />
        <div class="content">
            <p class="hoverForet nom"><?= $foret['nom_foret']?></p>
            <p class="hoverForet ville"><?= $foret['ville']?></p>
        </div>
    </article>
<?php
}

$titre = 'Liste des forêt';
$contenu = ob_get_clean();
require "view/template.php";



