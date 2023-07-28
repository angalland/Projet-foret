<?php
ob_start();?>

<?php
$titre = 'Detail de la randonnées';
$contenu = ob_get_clean();

require "view/template.php";