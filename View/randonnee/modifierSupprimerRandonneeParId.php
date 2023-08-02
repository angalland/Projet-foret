<?php
ob_start();?>

<?php
$titre = 'Modifier/Supprimer randonnée';
$contenu = ob_get_clean();

require "view/template.php";