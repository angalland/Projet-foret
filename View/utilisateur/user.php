<?php
ob_start();?>

<article>
<?php
    foreach($requete as $user){?>
        <p>Pseudo : <?=$user['pseudo']?></p>
        <p>Commentaire foret :</p>
    <?php
    foreach($requeteForet as $foret){?>
        <p><?=$foret['nom_foret']?> <?=$foret['commentaire']?></p>
    <?php
    }
    }?>
</article>
<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";