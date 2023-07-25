<?php
ob_start();

foreach ($requete as $foret) {
    $id_forets [] = $foret['id_foret'];
    $nom_forets [] = $foret['nom_foret'];
    $ville = $foret['ville'];
    $code_postal = $foret['code_postal'];
    $photo = $foret['photo'];
    $descriptif = $foret['descriptif'];
}
var_dump($id_forets);
var_dump($nom_forets);
?>
<form id="formAddForet" class="formH3 addH3Foret" action="" method="POST">
    <h3 class="formH3 addH3Foret">Choississez la forêt à modifier</h3>

    <div class="addDivForet">
        <label class="addLabel" for="nom_foret">Forêt : </label>
        <select name="forêt" id="nom_foret" class="inputConnexion">
            <option value=""></option>
            <option
            <?php foreach ($id_forets as $id_foret){?>
                    value="<?=$id_foret?>"
                    <?php } ?>><?php
                    foreach ($nom_forets as $nom_foret){?>
                        <?=$nom_foret?><?php
                    }?>
            </option>                      
        </select>
    </div>

    <div class="addButtonForet ">
        <input class="button updateButtonForet" type="submit" name="submitAddForet" value='Modifier'>
    </div>
</form>

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

$titre = 'Ajouter une forêt';
$contenu = ob_get_clean();

require "view/template.php";