<?php
ob_start();?>

<h2>Ajouter une forêt</h2>

<form action="index.php?action=addForet" method="POST" enctype="multipart/form-data">

    <label for="nom_foret">Nom</label>
    <input type="text" name="nom_foret" id="nom_foret">

    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville">

    <label for="code_postal">Code postal</label>
    <input type="text" name="code_postal" id="code_postal">

    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo">

    <label for="descriptif">Description</label>
    <input type="text" name="descriptif" id="descriptif">
</form>

<?php
$titre = 'Ajouter une forêt';
$contenu = ob_get_clean();

require "view/template.php";