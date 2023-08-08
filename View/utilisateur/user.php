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
<form action="" method="POST" id="formAddForet">
    <div class="addButtonForet ">
        <input class="button" type="submit" name="" value='Modifier adresse email'>
    </div>

    <div class="addButtonForet ">
        <input class="button" type="submit" name="" value='Modifier mot de passe'>
    </div>
</form>

<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";