<?php
ob_start();?>

<!-- Modal caché d'inscription -->
<div class="modal-container">
    <div class="overlay modal-trigger">
    </div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <form class="formDeletePersonne" method="POST" action="index.php?action=inscription">
                <h3 class="h3Modal"> Inscription </h3>
                <div>
                    <input type="email" placeholder="email" name="email">
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe" name="password">
                </div>
                <div>
                    <input type="password" placeholder="Confirmer mot de passe" name="confirmPassword">
                </div>
                <div class="inputCasting">
                    <input type="submit" value='inscription'>
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

<button class="btn-open modal-trigger">S'inscrire</button>


<?php
$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";