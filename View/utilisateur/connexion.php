<?php
ob_start();?>

<form id="formConnexion" method="POST" action="index.php?action=login">
    <h3 class="formH3">Connexion</h3>
    <div>
        <input class="inputConnexion" type="text" placeholder="Pseudo" name="pseudo">
    </div>
    <div>
        <input class="inputConnexion" type="email" placeholder="email" name="email">
    </div>
    <div>
        <input class="inputConnexion" type="password" placeholder="Mot de passe" name="password">
    </div>
    <div>
        <input class="button" type="submit" value='connexion'>
    </div>
</form>


<?php
$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";