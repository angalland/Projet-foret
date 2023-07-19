<?php
ob_start();?>
    <article class="articleDetailArbre">
        <?php foreach ($requete as $plante){?>
            <h1><?=$plante['nom_courant']?></h1>
            <div class="caracteristique">
            <p class="detail">Caractéristique : <?=$plante['nom_categorie']?></p>
            <p class="detail">Classe : <?=$plante['nom_classe']?></p>
            <p class="detail">Ordre : <?=$plante['nom_ordre']?></p>
            <p class="detail">Famille : <?=$plante['nom_famille']?></p>
            <p class="detail">Espece : <?=$plante['nom_espece']?></p>
            <?php
            if (isset($plante['taille'])){?>
            <p class="detail">Taille : <?=$plante['taille']?> Mètre</p><?php
            }
            if (isset($plante['poids'])){?>
            <p class="detail">Poids : <?=$plante['poids']?> KG</p><?php
            }?>
            <img class="repartition" src="<?=$plante['photo_repartition']?>"/>
            </div>
            <?php
            if (isset($plante['descriptif'])){?>
            <p class="detail">Descriptif : </p>
            <p class="detail"><?=$plante['descriptif']?></p><?php
            }?>
            <img class="imgDetailArbre" src="<?=$plante['photo']?>"/>
    </article><?php
    }?>

<?php
$titre = 'Detail plante';
$contenu = ob_get_clean();

require "view/template.php";