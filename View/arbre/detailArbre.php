<?php
ob_start();?>
<div id="divDetailForet">
    <article class="articleDetailForet">
        <?php foreach ($requete as $foret){?>
            <h1><?=$foret['nom_foret']?></h1>
            <p><?=$foret['descriptif']?></p>
            <img class="imgDetailForet" src="<?=$foret['photo']?>"/><?php
        ?>
    </article><?php
    }?>
</div>

<?php
$titre = 'Detail Arbre';
$contenu = ob_get_clean();

require "view/template.php";