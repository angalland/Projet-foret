<?php
ob_start();?>
<form action="" method="POST">

    <label for="nom_randonnee">Nom de la randonnee : </label>
    <input type="text" name="nom_randonnee" id="nom_randonnee">

    <label for="duree">Durée en Min : </label>
    <input type="number" name="duree" id="duree">

    <label for="difficulte">Difficulte : </label>
    <input type="number" name="difficulte" id="difficulte">
    
<?php
$titre = 'ajouter une randonnée';
$contenu = ob_get_clean();

require "view/template.php";