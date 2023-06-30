<?php
ob_start();?>

<p>Test</p>

<?php
$titre = 'Detail forêt';
$contenu = ob_get_clean();

require "view/template.php";