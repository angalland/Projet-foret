<?php
ob_start();?>

<div id="map"></div>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";