<?php
ob_start();?>

<?php
$titre = 'Choisir le parcours a supprimer';
$contenu = ob_get_clean();

require "view/template.php";