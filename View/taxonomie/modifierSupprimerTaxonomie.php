<?php
ob_start();?>
<div class="taxonomie">
    <form class="formClasse" action="index.php?action=viewUpdateTaxonomieById" method="POST">
        <h3 class="formH3 addH3Foret">Choississez la classe à modifier ou Supprimer</h3>

        <div class="divClasse">
            <label class="addLabel" for="nom_classe">Classe : </label>
            <select name="classe" id="nom_classe" class="inputConnexion">
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
            <input class="button" type="submit" name="submitUpdateClasse" value='Modifier'>
        </div>
    </form>
<div>

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