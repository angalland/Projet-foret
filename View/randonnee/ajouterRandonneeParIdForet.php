<?php
ob_start();?>
<form action="" method="POST" class="formAddRandonnee">

    <h3 class="formH3 addH3Foret">Ajouter une randonnée</h3>

    <div class="addDiv">
    <label for="nom_randonnee" class="addLabel">Nom de la randonnee : </label>
    <input type="text" name="nom_randonnee" id="nom_randonnee" class="inputConnexion">
    </div>

    <div class="addDiv">
    <label for="duree" class="addLabel">Durée en Min : </label>
    <input type="number" name="duree" id="duree" class="inputConnexion">
    </div>

    <div class="addDiv">
    <label for="difficulte" class="addLabel">Difficulte : </label>
    <input type="number" name="difficulte" id="difficulte" class="inputConnexion">
    </div>

    <div class="addButtonForet ">
        <input class="buttonPointRandonneeAdd" type="submit" name="submitAddForet" value='Ajouter une randonnée'>
    </div>

</form>
<?php
$titre = 'ajouter une randonnée';
$contenu = ob_get_clean();

require "view/template.php";