<?php
ob_start(); ?>

<?php

$titre = "Accueille";
$contenu = ob_get_clean();
require "view/template.php";