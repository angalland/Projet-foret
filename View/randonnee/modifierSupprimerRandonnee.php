<?php
ob_start();?>

<?php
$titre = 'choisir la randonnée que l\'on veut modifier';
$contenu = ob_get_clean();

require "view/template.php";