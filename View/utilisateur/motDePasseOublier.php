<?php
ob_start();

?>

<?php
$titre = 'Mot de passe oublier';
$contenu = ob_get_clean();
require "view/template.php";