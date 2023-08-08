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
<form action="" method="POST" id="formUserUpdate">

    <input class="buttonUpdateUser" type="submit" name="" value='Modifier adresse email'>

    <input class="buttonUpdateUser" type="submit" name="" value='Modifier mot de passe'>

    <input class="buttonUpdateUser" type="submit" name="" value='Supprimer compte'>

</form>

<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";