<?php
ob_start();?>

<form id="formConnexion" method="POST" action="index.php?action=login">
    <h3>Connexion</h3>
    <div>
        <input type="text" placeholder="Pseudo" name="pseudo">
    </div>
    <div>
        <input type="email" placeholder="email" name="email">
    </div>
    <div>
        <input type="password" placeholder="Mot de passe" name="password">
    </div>
    <div>
        <input type="submit" value='connexion'>
    </div>
</form>


<?php
$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";