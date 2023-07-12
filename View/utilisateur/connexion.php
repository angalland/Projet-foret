<?php
ob_start();?>

<div id="login">
<!-- Modal caché d'inscription -->
<div class="modal-container">
    <div class="overlay modal-trigger">
    </div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <form id="formConnexion" method="POST" action="index.php?action=inscription">
                <h3 class="formH3"> Inscription </h3>
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
                    <input class="inputConnexion" type="password" placeholder="Confirmer mot de passe" name="confirmPassword">
                </div>
                <div>
                    <input class="button" type="submit" value='inscription'>
                </div>
            </form>
        </div>
</div>

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

<button class="btn-open modal-trigger button">S'inscrire</button>

</div>

<?php
$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";