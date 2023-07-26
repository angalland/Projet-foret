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

    <form class="formClasse" action="index.php?action=viewUpdateTaxonomieById" method="POST">
        <h3 class="formH3 addH3Foret">Choississez l'ordre à modifier ou Supprimer</h3>

        <div class="divClasse">
            <label class="addLabel" for="nom_ordre">Ordre : </label>
            <select name="ordre" id="nom_ordre" class="inputConnexion">
                <option value=""></option>
                <?php
                foreach ($requeteOrdre as $ordre){?>
                    <option value="<?=$ordre["id_ordre"]?>">
                    <?=$ordre['nom_ordre']?></option>                      
                <?php
                }?>
            </select>
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitUpdateOrdre" value='Modifier'>
        </div>
    </form>

    <form class="formClasse" action="index.php?action=viewUpdateTaxonomieById" method="POST">
        <h3 class="formH3 addH3Foret">Choississez la famille à modifier ou Supprimer</h3>

        <div class="divClasse">
            <label class="addLabel" for="nom_famille">Famille : </label>
            <select name="famille" id="nom_famille" class="inputConnexion">
                <option value=""></option>
                <?php
                foreach ($requeteFamille as $famille){?>
                    <option value="<?=$famille["id_famille"]?>">
                    <?=$famille['nom_famille']?></option>                      
                <?php
                }?>
            </select>
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitUpdateFamille" value='Modifier'>
        </div>
    </form>

    <form class="formClasse" action="index.php?action=viewUpdateTaxonomieById" method="POST">
        <h3 class="formH3 addH3Foret">Choississez l'espece à modifier ou Supprimer</h3>

        <div class="divClasse">
            <label class="addLabel" for="nom_espece">Espece : </label>
            <select name="espece" id="nom_espece" class="inputConnexion">
                <option value=""></option>
                <?php
                foreach ($requeteEspece as $espece){?>
                    <option value="<?=$espece["id_espece"]?>">
                    <?=$espece['nom_espece']?></option>                      
                <?php
                }?>
            </select>
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitUpdateEspece" value='Modifier'>
        </div>
    </form>

    <form class="formClasse" action="index.php?action=viewUpdateTaxonomieById" method="POST">
        <h3 class="formH3 addH3Foret">Choississez la catégorie à modifier ou Supprimer</h3>

        <div class="divClasse">
            <label class="addLabel" for="nom_categorie">Catégorie : </label>
            <select name="categorie" id="nom_categorie" class="inputConnexion">
                <option value=""></option>
                <?php
                foreach ($requeteCategorie as $categorie){?>
                    <option value="<?=$categorie["id_categorie"]?>">
                    <?=$categorie['nom_categorie']?></option>                      
                <?php
                }?>
            </select>
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitUpdateCategorie" value='Modifier'>
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