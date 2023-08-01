<?php
ob_start();?>

<form action="index.php?action=addRandonneeByForet" method="POST" class="formAddRandonnee">

    <h3 class="formH3 addH3Foret">Ajouter une randonnée</h3>

    <div class="addDiv">
        <label for="nom_randonnee" class="addLabel">Nom de la randonnee : </label>
        <input type="text" name="nom_randonnee" id="nom_randonnee" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label for="duree" class="addLabel">Durée en Min : </label>
        <input type="number" name="duree" id="duree" class="inputConnexion" min="0">
    </div>

    <div class="addDiv">
        <label for="difficulte" class="addLabel">Difficulte : </label>
        <input type="number" name="difficulte" id="difficulte" class="inputConnexion" min="0">
    </div>

    <div class="addDivForetRandonnee">
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
        <input class="buttonPointRandonneeAdd" type="submit" name="submitAddRandonneeByForet" value='Ajouter une randonnée'>
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

$titre = 'Choissir la foret dont on veut ajouter une randonnee';
$contenu = ob_get_clean();

require "view/template.php";