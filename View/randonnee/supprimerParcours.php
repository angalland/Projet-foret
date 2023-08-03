<?php
ob_start();?>
<form id="formAddForet" class="formH3 addH3Foret" action="index.php?action=viewDeleteParcoursByRandonnee" method="POST">
    <h3 class="formH3 addH3Foret">Choississez la randonnée dont il faut supprimer un parcours</h3>

    <div class="addDivForet">
        <label class="addLabel" for="nom_randonnee">Randonnée : </label>
        <select name="randonnee" id="nom_randonnee" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requete as $randonnee){?>
                <option value="<?=$randonnee["id_randonnee"]?>">
                <?=$randonnee['nom_randonnee']?></option>                      
            <?php
            }?>
        </select>
    </div>

    <div class="addButtonForet ">
        <input class="button updateButtonForet" type="submit" name="submitDeleteParcours" value='Choissir'>
    </div>
</form>
<?php
$titre = 'Choisir la randonnée dont vous voulez supprimer un parcours';
$contenu = ob_get_clean();

require "view/template.php";