<?php
ob_start();
foreach ($requete as $etre_vivant){?>
    <form action="index.php?action=updateForet&id=<?=$etre_vivant['id_etre_vivant']?>" method="POST" id="formAddForet" enctype="multipart/form-data">

        <input type="hidden" name='anciennePhoto' value='<?=$etre_vivant['photo']?>'>
        <input type="hidden" name='anciennePhotoRepartition' value='<?=$etre_vivant['photo_repartition']?>'>

        <h3 class="formH3 addH3Foret">
            Modifier <?=$etre_vivant['nom_courant']?>
        </h3>

        <div class="addDiv">
            <label class="addLabel" for="nom_courant">Nom Courant :</label>
            <input type="text" name="nom_courant" id="nom_courant" class="inputConnexion" value="<?=$etre_vivant['nom_courant']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="nom_latin">Nom Latin :</label>
            <input type="text" name="nom_latin" id="nom_latin" class="inputConnexion" value="<?=$etre_vivant['nom_latin']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="taille">Taille :</label>
            <input type="number" name="taille" id="taille" min="0" class="inputConnexion" value="<?=$etre_vivant['taille']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="poids">Poids :</label>
            <input type="number" name="poids" id="poids" min="0" class="inputConnexion" value="<?=$etre_vivant['poids']?>">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="photo">Photo :</label>
            <input type="file" name="photo" id="photo" class="file">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="photo_repartition">Photo Répartition :</label>
            <input type="file" name="photo_repartition" id="photo_repartition" class="file">
        </div>

        <div class="addDiv">
            <label class="addLabel" for="id_classe">Classe :</label>
            <select name="id_classe" id="id_classe" class="inputConnexion">
                <option value="">Choississez la classe</option>
                <?php
                foreach ($requeteClasse as $classe){?>
                    <option value="<?=$classe['id_classe']?>">
                    <?=$classe['nom_classe']?></option><?php
                }?>
            </select>
        </div>

        <div class="addDiv">
        <label class="addLabel" for="id_ordre">Ordre :</label>
        <select name="id_ordre" id="id_ordre" class="inputConnexion">
            <option value="">Choississez l'ordre</option>
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
            <option value="">Choississez la famille</option>
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
            <option value="">Choississez l'espece</option>
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
            <option value="">Choississez la catégorie</option>
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
            <input type="text" name="descriptif" id="descriptif" class="inputConnexion" value="<?=$etre_vivant['descriptif']?>">
        </div>

        <div class="addButtonForet updateEtreVivant">
            <input class="button" type="submit" name="submitUpdateForet" value='Modifier'>
        </div>

        <div class="addButtonForet updateEtreVivant">
            <input class="button" type="submit" name="submitDeleteForet" value='Supprimer'>
        </div>
    </form><?php
}


$titre = 'Modifier/Supprimer un etre vivant';
$contenu = ob_get_clean();

require "view/template.php";