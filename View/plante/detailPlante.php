<?php
ob_start();?>
    <article class="articleDetailArbre">
        <?php foreach ($requete as $plante){?>
            <h1><?=$plante['nom_courant']?></h1>
            <div class="caracteristique">
            <p class="detail">Caractéristique : <?=$plante['nom_categorie']?></p>
            <p class="detail">Classe : <?=$plante['nom_classe']?></p>
            <p class="detail">Ordre : <?=$plante['nom_ordre']?></p>
            <p class="detail">Famille : <?=$plante['nom_famille']?></p>
            <p class="detail">Espece : <?=$plante['nom_espece']?></p>
            <?php
            if (isset($plante['taille'])){?>
            <p class="detail">Taille : <?=$plante['taille']?> Cm</p><?php
            }
            if (isset($plante['poids'])){?>
            <p class="detail">Poids : <?=$plante['poids']?> KG</p><?php
            }?>
            <img class="repartition" src="<?=$plante['photo_repartition']?>"/>
            </div>
            <?php
            if (isset($plante['descriptif'])){?>
            <p class="detail">Descriptif : </p>
            <p class="detail"><?=$plante['descriptif']?></p><?php
            }?>
            <img class="imgDetailArbre" src="<?=$plante['photo']?>"/>
    </article><?php
    }?>

<article  class="commentaire">
    <h2>Commentaire :</h2>
    <?php
    foreach ($requeteCommentaire as $commentaire){?>
        <div id="commentaireModification">
            <p><?= $commentaire['pseudo']?> : <?= $commentaire['commentaire']?></p><?php
            if (isset($_SESSION['user'])){
                if ($commentaire['id_utilisateur'] == $_SESSION['user']['id_utilisateur']){?>
                    <button class="modifier button">Modifier</button>
                    <button class="supprimer button"><a href="index.php?action=supprimerCommentairePlante&id=<?=$commentaire['id_commentaire_plante']?>&id_etre_vivant=<?=$commentaire['id_etre_vivant']?>">Supprimer</a></button>
        </div>

        <div class="formulaireModiffier">
            <button class="fermeture">X</button>
                <form action="index.php?action=modifierCommentairePlante&id=<?=$commentaire['id_commentaire_plante']?>&id_etre_vivant=<?=$commentaire['id_etre_vivant']?>" method="POST">
                    <input class="inputCommentaire" type="text" name="modifierCommentaire" placeholder="<?= $commentaire['commentaire']?>"/>
                    <input class="button" type="submit" name="submit_update_commentaire" value="Modifier">
                </form>
        </div><?php
            }
        }
    }

    if (isset($_SESSION['user'])){?>         
        <form action="index.php?action=posterCommentairePlante&id=<?=$_SESSION['user']['id_utilisateur']?>&id_etre_vivant=<?=$id_etre_vivant?>" method="POST">
            <input class="inputCommentaire" type="text" name="commentaire" placeholder="Votre commentaire">
            <input class="button" type="submit" name="submit_commentaire" value="poster">
        </form><?php
    } else {?>
        <div id="commentaireConnexion">
        <p> Vous devez être connecter pour poster un commentaire</p>
        <button class="button"><a href="index.php?action=connexion">Se connecter</a></button>
        </div>
        <?php
    }?>  
</article>

<?php
$titre = 'Detail plante';
$contenu = ob_get_clean();

require "view/template.php";