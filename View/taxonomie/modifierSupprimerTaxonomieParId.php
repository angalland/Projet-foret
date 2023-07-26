<?php
ob_start();
if (isset($requeteClasse)){
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
    }
} elseif (isset($requeteOrdre)){
    foreach ($requeteOrdre as $ordre){?>
        <form action="index.php?action=updateClasse&id=<?=$ordre['id_ordre']?>" method="POST" id="formAddForet">

            <h3 class="formH3 addH3Foret">
                Modifier <?=$ordre['nom_ordre']?>
            </h3>

            <div class="updateDiv">
                <label class="addLabel" for="nom_ordre">Nom :</label>
                <input type="text" name="nom_ordre" id="nom_ordre" class="inputConnexion" value="<?=$ordre['nom_ordre']?>">
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitUpdateOrdre" value='Modifier'>
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitDeleteOrdre" value='Supprimer'>
            </div>
        </form><?php
    }    
} elseif (isset($requeteFamille)){
    foreach ($requeteFamille as $famille){?>
        <form action="index.php?action=updateClasse&id=<?=$famille['id_famille']?>" method="POST" id="formAddForet">

            <h3 class="formH3 addH3Foret">
                Modifier <?=$famille['nom_famille']?>
            </h3>

            <div class="updateDiv">
                <label class="addLabel" for="nom_famille">Nom :</label>
                <input type="text" name="nom_famille" id="nom_famille" class="inputConnexion" value="<?=$famille['nom_famille']?>">
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitUpdateFamille" value='Modifier'>
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitDeleteFamille" value='Supprimer'>
            </div>
        </form><?php
    }  
} elseif (isset($requeteEspece)){
    foreach ($requeteEspece as $espece){?>
        <form action="index.php?action=updateClasse&id=<?=$espece['id_espece']?>" method="POST" id="formAddForet">

            <h3 class="formH3 addH3Foret">
                Modifier <?=$espece['nom_espece']?>
            </h3>

            <div class="updateDiv">
                <label class="addLabel" for="nom_espece">Nom :</label>
                <input type="text" name="nom_espece" id="nom_espece" class="inputConnexion" value="<?=$espece['nom_espece']?>">
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitUpdateEspece" value='Modifier'>
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitDeleteEspece" value='Supprimer'>
            </div>
        </form><?php
    }      
} elseif (isset($requeteCategorie)) {
    foreach ($requeteCategorie as $categorie){?>
        <form action="index.php?action=updateClasse&id=<?=$categorie['id_categorie']?>" method="POST" id="formAddForet">

            <h3 class="formH3 addH3Foret">
                Modifier <?=$categorie['nom_categorie']?>
            </h3>

            <div class="updateDiv">
                <label class="addLabel" for="nom_categorie">Nom :</label>
                <input type="text" name="nom_categorie" id="nom_categorie" class="inputConnexion" value="<?=$categorie['nom_categorie']?>">
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitUpdateCategorie" value='Modifier'>
            </div>

            <div class="addButtonForet ">
                <input class="button" type="submit" name="submitDeleteCategorie" value='Supprimer'>
            </div>
        </form><?php
    }  
}
?>
<?php
$titre = 'Modifier, supprimer une taxonomie';
$contenu = ob_get_clean();

require "view/template.php";