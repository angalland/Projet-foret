<?php
ob_start();

?>

<div id="login">
    <?php
    // affiche un message de succes si il y en a un 
    if (isset($_SESSION['messageSucces'])) {?>
        <p><?= $_SESSION['messageSucces'];?></p><?php
        unset($_SESSION['messageSucces']);
    };
    // affiche un message d'alerte si il y en a un
    if (isset($_SESSION['messageAlert'])) {
        foreach ($_SESSION['messageAlert'] as $alert){?>
            <p><?= $alert ?></p><?php
            unset($_SESSION['messageAlert']);
        }
    };?>
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

<!-- modal caché mot de passe oublier -->
<div class="module-conteneur-mdpOublier">
    <div class="couverture moduleMdpOublier-trigger">
    </div>
        <div class="module-mdpOublier">
            <button class="close-modal moduleMdpOublier-trigger">X</button>
            <form id="formConnexion" method="POST" action="index.php?action=inscription">
                <h3 class="formH3">Veuillez-saisir votre email et votre pseudo </h3>
                <div>
                    <input class="inputConnexion" type="text" placeholder="Pseudo" name="pseudo">
                </div>
                <div>
                    <input class="inputConnexion" type="email" placeholder="email" name="email">
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
<button class="btn-open moduleMdpOublier-trigger button">Mot de passe oublier ?</button>
</div>

<?php
$titre = 'Connexion';
$contenu = ob_get_clean();
require "view/template.php";