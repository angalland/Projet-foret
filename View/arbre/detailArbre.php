<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $arbre){?>
            <h1><?=$arbre['nom_courant']?></h1>
            <p>Caractéristique : <?=$arbre['nom_categorie']?></p>
            <p>Classe : <?=$arbre['nom_classe']?></p>
            <p>Ordre : <?=$arbre['nom_ordre']?></p>
            <p>Famille : <?=$arbre['nom_famille']?></p>
            <p>Espece : <?=$arbre['nom_espece']?></p>
            <img src="<?=$arbre['photo_repartition']?>"/>
            <img class="imgDetailForet" src="<?=$arbre['photo']?>"/>
            <p>Descriptif : </p>
            <p><?=$arbre['descriptif']?></p>
    </article><?php
    }?>
</div>

<?php
$titre = 'Detail Arbre';
$contenu = ob_get_clean();

require "view/template.php";