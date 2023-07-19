<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $arbre){?>
            <h1><?=$arbre['nom_courant']?></h1>
            <p><?=$arbre['descriptif']?></p>
            <img class="imgDetailForet" src="<?=$arbre['photo']?>"/><?php
        ?>
    </article><?php
    }?>
</div>

<?php
$titre = 'Detail Arbre';
$contenu = ob_get_clean();

require "view/template.php";