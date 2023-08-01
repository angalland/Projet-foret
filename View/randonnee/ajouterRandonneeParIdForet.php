<?php
ob_start();?>

<?php

$titre = 'ajouter une randonnée';
$contenu = ob_get_clean();

require "view/template.php";