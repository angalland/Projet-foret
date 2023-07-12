<?php
ob_start();?>

<form 




$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";