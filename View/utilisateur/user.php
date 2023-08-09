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

    <a title="Paramètre" id="parametre"><div id="iconsUser">&#9881</div></a>

</article>


<!-- <form action="index.php?action=UpdateDeleteUser" method="POST" id="formUserUpdate"> -->
<div id="UserUpdate">

    <button class="btn-open modulepseudo-trigger buttonUpdateUser">Modifier pseudo</button>

    <button class="btn-open modal-trigger buttonUpdateUser">Modifier adresse email</button>

    <button class="btn-open module-trigger buttonUpdateUser">Modifier mot de passe</button>

    <button class="btn-open modulemdp-trigger  buttonUpdateUser">Supprimer compte</button>
</div>

<!-- Modal caché modifie pseudo-->
<div class="module-conteneur-pseudo">
    <div class="couverture modulepseudo-trigger">
    </div>
        <div class="module-pseudo">
            <button class="close-modal modulepseudo-trigger">X</button>
            <form id="formConnexion" method="POST" action="index.php?action=updatePseudo">
                <h3 class="formH3"> Modifier pseudo </h3>
                <div>
                    <input class="inputConnexion" type="text" placeholder="Pseudo" name="pseudo">
                </div>
                <div>
                    <input class="button" type="submit" value='Modifier' name="updatePseudo">
                </div>
            </form>
        </div>
</div>

<!-- Modal caché email-->
<div class="modal-container">
    <div class="overlay modal-trigger">
    </div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <form id="formConnexion" method="POST" action="">
                <h3 class="formH3"> Modifier l'email </h3>

                <div>
                    <input class="inputConnexion" type="email" placeholder="email" name="email">
                </div>

                <div>
                    <input class="button" type="submit" value='Modifier'>
                </div>
            </form>
        </div>
</div>

<!-- Modal caché mot de passe-->
<div class="module-conteneur">
    <div class="couverture module-trigger">
    </div>
        <div class="module">
            <button class="close-modal module-trigger">X</button>
            <form id="formConnexion" method="POST" action="">
                <h3 class="formH3"> Modifier le mot de passe </h3>
                <div>
                    <input class="inputConnexion" type="text" placeholder="Mot de passe" name="passe">
                </div>
                <div>
                    <input class="inputConnexion" type="password" placeholder="Confirmer mot de passe" name="confirmPassword">
                </div>

                <div>
                    <input class="button" type="submit" value='Modifier'>
                </div>
            </form>
        </div>
</div>

<!-- Modal caché suppression de compte-->
<div class="module-conteneur-mdp">
    <div class="couverture modulemdp-trigger">
    </div>
        <div class="module-mdp">
            <button class="close-modal modulemdp-trigger">X</button>
            <form id="formConnexion" method="POST" action="">
                <h3 class="formH3"> Confirmer la suppression de votre compte, cette action est définitive </h3>
                <div>
                    <button class="button deconnexion" type="submit" value="true" name="deconnexion">Oui</button>
                </div>
                <div>  
                    <button class="button deconnexion" type="submit" value="false" name="deconnexion">Non</button>
                </div>
            </form>
        </div>
</div>

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
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";