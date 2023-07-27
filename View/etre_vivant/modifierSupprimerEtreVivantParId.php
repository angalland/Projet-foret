<?php
ob_start();?>

<?php
$titre = 'Modifier/Supprimer un etre vivant';
$contenu = ob_get_clean();

require "view/template.php";