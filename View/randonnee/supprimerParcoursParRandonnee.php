<?php
ob_start();?>

<?php
$titre = 'Supprimer parcours';
$contenu = ob_get_clean();

require "view/template.php";