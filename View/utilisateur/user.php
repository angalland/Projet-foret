<?php
ob_start();?>

<article id="user">
<?php
    foreach($requete as $user){
        $date = $user['createAt'];
        $dt = new DateTime($date);
        ?>
        <p>Pseudo : <?=$user['pseudo']?></p>
        <p>Email : <?=$user['email']?></p>
        <p>Date de création du compte : <?=$dt->format("d/m/Y")?></p>
    <?php 
    }?>

</article>
<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";