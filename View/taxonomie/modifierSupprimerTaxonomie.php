<?php
ob_start();?>

<form id="formAddForet" class="formH3 addH3Foret" action="index.php?action=viewUpdateForetById" method="POST">
    <h3 class="formH3 addH3Foret">Choississez la classe à modifier ou Supprimer</h3>

    <div class="addDivForet">
        <label class="addLabel" for="nom_foret">Classe : </label>
        <select name="foret" id="nom_foret" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteClasse as $classe){?>
                <option value="<?=$classe["id_classe"]?>">
                <?=$classe['nom_classe']?></option>                      
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

$titre = 'Modifier, supprimer une taxonomie';
$contenu = ob_get_clean();

require "view/template.php";