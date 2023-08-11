<?php
ob_start();
?>
<form id="formConnexion" method="POST" action="index.php?action=forgetPassword&id=<?=$_SESSION['mdp']['id_utilisateur']?>">
    <h3 class="formH3"> Modifier le mot de passe </h3>
    <div>
        <input class="inputConnexion" type="password" placeholder="Mot de passe" name="password">
    </div>
    <div>
        <input class="inputConnexion" type="password" placeholder="Confirmer mot de passe" name="confirmPassword">
    </div>
    <div>
        <input class="button" type="submit" value='Modifier' name="mdpOublier">
    </div>
</form>
<?php
// affiche un message succes si il y en a un 
if (isset($_SESSION['messageSucces'])) {?>
    <p class="uk-alert-success"><?= $_SESSION['messageSucces'];?></p><?php
    unset($_SESSION['messageSucces']);
};
// affiche un message alert si il y en a un 
if (isset($_SESSION['messageAlert'])) {
    foreach ($_SESSION['messageAlert'] as $alert){?>
        <div class='alert'><?= $alert ?></div><?php
        unset($_SESSION['messageAlert']);
    }
};
$titre = 'Mot de passe oublier';
$contenu = ob_get_clean();
require "view/template.php";