<?php
ob_start();?>
    <article class="articleDetailArbre">
        <?php foreach ($requete as $arbre){?>
            <h1><?=$arbre['nom_courant']?></h1>
            <div class="caracteristique">
            <p class="detail">Caractéristique : <?=$arbre['nom_categorie']?></p>
            <p class="detail">Classe : <?=$arbre['nom_classe']?></p>
            <p class="detail">Ordre : <?=$arbre['nom_ordre']?></p>
            <p class="detail">Famille : <?=$arbre['nom_famille']?></p>
            <p class="detail">Espece : <?=$arbre['nom_espece']?></p>
            <?php
            if (isset($arbre['taille'])){?>
            <p class="detail">Taille : <?=$arbre['taille']?> Mètre</p><?php
            }
            if (isset($arbre['poids'])){?>
            <p class="detail">Poids : <?=$arbre['poids']?> KG</p><?php
            }?>
            <img class="repartition" src="<?=$arbre['photo_repartition']?>"/>
            </div>
            <?php
            if (isset($arbre['descriptif'])){?>
            <p class="detail">Descriptif : </p>
            <p class="detail"><?=$arbre['descriptif']?></p><?php
            }?>
            <img class="imgDetailArbre" src="<?=$arbre['photo']?>"/>
    </article><?php
    }?>

<?php
$titre = 'Detail Arbre';
$contenu = ob_get_clean();

require "view/template.php";