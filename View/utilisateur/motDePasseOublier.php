<?php
ob_start();
?>
<form id="formConnexion" method="POST" action="index.php?action=forgetPassword&id=<?=$_SESSION['user']['id_utilisateur']?>">
    <h3 class="formH3"> Modifier le mot de passe </h3>
    <div>
        <input class="inputConnexion" type="password" placeholder="Mot de passe" name="password">
    </div>
    <div>
        <input class="inputConnexion" type="password" placeholder="Confirmer mot de passe" name="confirmPassword">
    </div>
    <div>
        <input class="button" type="submit" value='Modifier' name="updatePassword">
    </div>
</form>
<?php
$titre = 'Mot de passe oublier';
$contenu = ob_get_clean();
require "view/template.php";