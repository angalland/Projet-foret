<?php
ob_start();?>
<div class="taxonomie">
    <form action="index.php?action=addClasse" method="POST" class="formClasse">

        <h3 class="formH3 addH3Foret">Ajouter une classe</h3>

        <div class="divClasse"> 
            <label for="nom_classe" class="addLabel">Nom de la classe</label>
            <input type="text" name="nom_classe" id="nom_classe" class="inputConnexion">
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitAddClasse" value='Ajouter'>
        </div>
    </form>
    
    <form action="index.php?action=addClasse" method="POST" class="formClasse">

        <h3 class="formH3 addH3Foret">Ajouter un ordre</h3>

        <div class="divClasse"> 
            <label for="nom_ordre" class="addLabel">Nom de l'ordre</label>
            <input type="text" name="nom_ordre" id="nom_ordre" class="inputConnexion">
        </div>

        <div class="addButtonForet ">
            <input class="button" type="submit" name="submitAddOrdre" value='Ajouter'>
        </div>
    </form>
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

$titre = 'Ajouter une taxonomie';
$contenu = ob_get_clean();

require "view/template.php";