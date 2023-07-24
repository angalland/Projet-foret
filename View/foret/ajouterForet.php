<?php
ob_start();?>

<?php
$titre = 'Ajouter une forêt';
$contenu = ob_get_clean();

require "view/template.php";