<?php
ob_start();?>


<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";