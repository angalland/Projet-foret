<?php
ob_start();

foreach ($requete->fetchAll() as $foret){?>
    <article>
        <img src="<?= $foret['photo']?>" />
    </article>
<?php
}

$titre = 'Liste des forêt';
$contenu = ob_get_clean();
require "view/template.php";



