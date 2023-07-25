<?php
ob_start();
foreach ($requete as $foret){?>
<div class="updateDivForet">
    <form action="" method="POST">

        <div class="addDiv">
            <label class="addLabel" for="nom_foret">Nom :</label>
            <input type="text" name="nom_foret" id="nom_foret" class="inputConnexion" value="<?=$foret['nom_foret']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" class="inputConnexion" value="<?=$foret['ville']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="code_postal">Code postal :</label>
            <input type="text" name="code_postal" id="code_postal" class="inputConnexion" value="<?=$foret['code_postal']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="photo">Photo :</label>
            <input type="file" name="photo" id="photo" class="file">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="descriptif">Description :</label>
            <input type="text" name="descriptif" id="descriptif" class="inputConnexion" value="<?=$foret['descriptif']?>">
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitAddForet" value='Ajouter'>
        </div>
    </form><?php
}


// affiche un message succes si il y en a un 
if (isset($_SESSION['messageSucces'])) {?>
    <p class="uk-alert-success"><?= $_SESSION['messageSucces'];?></p><?php
    unset($_SESSION['messageSucces']);
};
// affiche un message alert si il y en a un 
if (isset($_SESSION['messageAlert'])) {
    foreach ($_SESSION['messageAlert'] as $alert){?>
        <div class='alert'><?= $alert ?></div><?php
        unset($_SESSION['messageAlert']);
    }
};

$titre = 'Modifier une forêt';
$contenu = ob_get_clean();

require "view/template.php";