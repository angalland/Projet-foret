<?php
ob_start();
foreach ($requeteClasse as $classe){?>
    <form action="index.php?action=updateClasse&id=<?=$classe['id_classe']?>" method="POST" id="formAddForet">

        <h3 class="formH3 addH3Foret">
            Modifier <?=$classe['nom_classe']?>
        </h3>

        <div class="updateDiv">
            <label class="addLabel" for="nom_classe">Nom :</label>
            <input type="text" name="nom_classe" id="nom_classe" class="inputConnexion" value="<?=$classe['nom_classe']?>">
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitUpdateClasse" value='Modifier'>
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitDeleteClasse" value='Supprimer'>
        </div>
    </form><?php
}?>

<?php
$titre = 'Modifier, supprimer une taxonomie';
$contenu = ob_get_clean();

require "view/template.php";