<?php
ob_start();

foreach ($requete->fetchAll() as $animaux){?>
    <article id="articleListArbre">
        <a href="">
            <img class="imgListArbre" src="<?= $animaux['photo']?>" />
            <div class="content">
                <p class="hoverForet nom"><?= $animaux['nom_courant']?></p>
                <p class="hoverForet ville"><?= $animaux['nom_latin']?></p>
            </div>
        </a>
    </article>
<?php
}

$titre = 'Liste des animaux';
$contenu = ob_get_clean();
require "view/template.php";