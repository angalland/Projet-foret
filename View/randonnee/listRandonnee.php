<?php
ob_start();?>

<?php
$titre = 'Liste des randonnées';
$contenu = ob_get_clean();

require "view/template.php";