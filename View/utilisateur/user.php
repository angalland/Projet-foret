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
    <button class="btn-open modal-trigger buttonUpdateUser">Modifier adresse email</button>

    <button class="btn-open modal-trigger buttonUpdateUser">Modifier mot de passe</button>

    <button class="btn-open modal-trigger  buttonUpdateUser">Supprimer compte</button>
</div>

<!-- Modal caché email-->
<div class="modal-container">
    <div class="overlay modal-trigger">
    </div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <form id="formConnexion" method="POST" action="index.php?action=inscription">
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
<div class="modal-container">
    <div class="overlay modal-trigger">
    </div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <form id="formConnexion" method="POST" action="index.php?action=inscription">
                <h3 class="formH3"> Modifier l'email </h3>

                <div>
                    <input class="inputConnexion" type="text" placeholder="Mot de passe" name="passe">
                </div>

                <div>
                    <input class="button" type="submit" value='Modifier'>
                </div>
            </form>
        </div>
</div>

<?php
$titre = 'Mon compte';
$contenu = ob_get_clean();
require "view/template.php";