<?php
ob_start();?>
<form id="formAddForet" action="index.php?action=addEtreVivant" method="POST" enctype="multipart/form-data">
    <h3 class="formH3 addH3Foret">Ajouter un etre vivant</h3>

    <div class="addDiv">
        <label class="addLabel" for="nom_courant">Nom courant :</label>
        <input type="text" name="nom_courant" id="nom_courant" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="nom_latin">Nom latin :</label>
        <input type="text" name="nom_latin" id="nom_latin" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="taille">Taille en Cm :</label>
        <input type="number" name="taille" id="taille" min="0" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="poids">Poids en Kg :</label>
        <input type="number" name="poids" id="poids" min="0" class="inputConnexion">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="photo">Photo :</label>
        <input type="file" name="photo" id="photo" class="file">
    </div>

    <div class="addDiv">
        <label class="addLabel" for="photo_repartition">Photo de la répartition :</label>
        <input type="file" name="photo_repartition" id="photo_repartition" class="file">
    </div>
    
    <div class="addDiv">
        <label class="addLabel" for="id_classe">Classe :</label>
        <select name="id_classe" id="id_classe" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteClasse as $classe){?>        
                <option value="<?=$classe['id_classe']?>">
                <?=$classe['nom_classe']?></option>
                <?php
            }?>
        </select>
    </div>

    <div class="addDiv">
        <label class="addLabel" for="id_ordre">Ordre :</label>
        <select name="id_ordre" id="id_ordre" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteOrdre as $ordre){?>        
                <option value="<?=$ordre['id_ordre']?>">
                <?=$ordre['nom_ordre']?></option>
                <?php
            }?>
        </select>
    </div>

    <div class="addDiv">
        <label class="addLabel" for="id_famille">Famille :</label>
        <select name="id_famille" id="id_famille" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteFamille as $famille){?>        
                <option value="<?=$famille['id_famille']?>">
                <?=$famille['nom_famille']?></option>
                <?php
            }?>
        </select>
    </div>

    <div class="addDiv">
        <label class="addLabel" for="id_espece">Espece :</label>
        <select name="id_espece" id="id_espece" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteEspece as $espece){?>        
                <option value="<?=$espece['id_espece']?>">
                <?=$espece['nom_espece']?></option>
                <?php
            }?>
        </select>
    </div>

    <div class="addDiv">
        <label class="addLabel" for="id_categorie">Catégorie :</label>
        <select name="id_categorie" id="id_categorie" class="inputConnexion">
            <option value=""></option>
            <?php
            foreach ($requeteCategorie as $categorie){?>        
                <option value="<?=$categorie['id_categorie']?>">
                <?=$categorie['nom_categorie']?></option>
                <?php
            }?>
        </select>
    </div>

    <div class="addDiv">
        <label class="addLabel" for="descriptif">Description :</label>
        <input type="text" name="descriptif" id="descriptif" class="inputConnexion">
    </div>

    <div class="addButtonForet ">
        <input class="button" type="submit" name="submitAddEtreVivant" value='Ajouter'>
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

$titre = 'Ajouter un etre vivant';
$contenu = ob_get_clean();

require "view/template.php";