<?php
ob_start();?>


<form id="formAddForet" action="index.php?action=addForet" method="POST" enctype="multipart/form-data">
    <h3 class="formH3 addH3Foret">Ajouter une forêt</h3>

    <div class="addDiv">
        <label class="addLabel" for="nom_foret">Nom :</label>
        <input type="text" name="nom_foret" id="nom_foret" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="ville">Ville :</label>
        <input type="text" name="ville" id="ville" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="code_postal">Code postal :</label>
        <input type="text" name="code_postal" id="code_postal" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="photo">Photo :</label>
        <input type="file" name="photo" id="photo" class="file">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="descriptif">Description :</label>
        <input type="text" name="descriptif" id="descriptif" class="inputConnexion">
    </div>

    <div class="addButtonForet ">
        <input class="button" type="submit" value='Ajouter'>
    </div>
</form>

<?php
$titre = 'Ajouter une forêt';
$contenu = ob_get_clean();

require "view/template.php";