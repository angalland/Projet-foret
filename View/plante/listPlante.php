<?php
ob_start();

foreach ($requete->fetchAll() as $plante){?>
    <article id="articleListArbre">
        <a href="index.php?action=detailPlante&id=<?=$plante['id_etre_vivant']?>">
            <img class="imgListArbre" src="<?= $plante['photo']?>" />
            <div class="content">
                <p class="hoverForet nom"><?= $plante['nom_courant']?></p>
                <p class="hoverForet ville"><?= $plante['nom_latin']?></p>
            </div>
        </a>
    </article>
<?php
}

$titre = 'Liste des plantes';
$contenu = ob_get_clean();
require "view/template.php";