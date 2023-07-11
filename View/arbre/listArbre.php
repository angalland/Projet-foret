<?php
ob_start();

foreach ($requete->fetchAll() as $arbre){?>
    <article id="articleListArbre">
        <a href="">
            <img class="imgListArbre" src="<?= $arbre['photo']?>" />
            <div class="content">
                <p class="hoverForet nom"><?= $arbre['nom_courant']?></p>
                <p class="hoverForet ville"><?= $arbre['nom_latin']?></p>
            </div>
        </a>
    </article>
<?php
}

$titre = 'Liste des arbres';
$contenu = ob_get_clean();
require "view/template.php";