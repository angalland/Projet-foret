<?php
ob_start();?>
    <article class="articleDetailArbre">
        <?php foreach ($requete as $animaux){?>
            <h1><?=$animaux['nom_courant']?></h1>
            <div class="caracteristique">
            <p class="detail">Caractéristique : <?=$animaux['nom_categorie']?></p>
            <p class="detail">Classe : <?=$animaux['nom_classe']?></p>
            <p class="detail">Ordre : <?=$animaux['nom_ordre']?></p>
            <p class="detail">Famille : <?=$animaux['nom_famille']?></p>
            <p class="detail">Espece : <?=$animaux['nom_espece']?></p>
            <?php
            if (isset($animaux['taille'])){?>
            <p class="detail">Taille : <?=$animaux['taille']?> Cm</p><?php
            }
            if (isset($animaux['poids'])){?>
            <p class="detail">Poids : <?=$animaux['poids']?> KG</p><?php
            }?>
            <img class="repartition" src="<?=$animaux['photo_repartition']?>"/>
            </div>
            <?php
            if (isset($animaux['descriptif'])){?>
            <p class="detail">Descriptif : </p>
            <p class="detail"><?=$animaux['descriptif']?></p><?php
            }?>
            <img class="imgDetailArbre" src="<?=$animaux['photo']?>"/>
    </article><?php
    }?>

<?php
$titre = 'Detail Animaux';
$contenu = ob_get_clean();

require "view/template.php";