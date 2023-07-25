<?php
ob_start();


?>
<form id="formAddForet" class="formH3 addH3Foret" action="index.php?action=viewUpdateForetById" method="POST">
    <h3 class="formH3 addH3Foret">Choississez la forêt à modifier</h3>

    <div class="addDivForet">
        <label class="addLabel" for="nom_foret">Forêt : </label>
        <select name="foret" id="nom_foret" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requete as $foret){?>
                <option value="<?=$foret["id_foret"]?>">
                <?=$foret['nom_foret']?></option>                      
            <?php
            }?>
        </select>
    </div>

    <div class="addButtonForet ">
        <input class="button updateButtonForet" type="submit" name="submitUpdateForet" value='Modifier'>
    </div>
</form>

<?php


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