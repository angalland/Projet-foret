<?php
ob_start();?>
    <article class="articleDetailArbre">
        <?php foreach ($requete as $arbre){
            $id_etre_vivant = $arbre['id_etre_vivant'];
            ?>
            <h1><?=$arbre['nom_courant']?></h1>
            <div class="caracteristique">
            <p class="detail">Caractéristique : <?=$arbre['nom_categorie']?></p>
            <p class="detail">Classe : <?=$arbre['nom_classe']?></p>
            <p class="detail">Ordre : <?=$arbre['nom_ordre']?></p>
            <p class="detail">Famille : <?=$arbre['nom_famille']?></p>
            <p class="detail">Espece : <?=$arbre['nom_espece']?></p>
            <?php
            if (isset($arbre['taille'])){?>
            <p class="detail">Taille : <?=$arbre['taille']?> Mètre</p><?php
            }
            if (isset($arbre['poids'])){?>
            <p class="detail">Poids : <?=$arbre['poids']?> KG</p><?php
            }?>
            <img class="repartition" src="<?=$arbre['photo_repartition']?>"/>
            </div>
            <?php
            if (isset($arbre['descriptif'])){?>
            <p class="detail">Descriptif : </p>
            <p class="detail"><?=$arbre['descriptif']?></p><?php
            }?>
            <img class="imgDetailArbre" src="<?=$arbre['photo']?>"/>
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
                        <button class="supprimer button"><a href="index.php?action=supprimerCommentaireForet&id=<?=$commentaire['id_commentaire_arbre']?>&id_foret=<?=$commentaire['id_etre_vivant']?>">Supprimer</a></button>
                </div>

                        <div class="formulaireModiffier">
                            <form action="index.php?action=modifierCommentaireArbre&id=<?=$commentaire['id_commentaire_arbre']?>&id_etre_vivant=<?=$commentaire['id_etre_vivant']?>" method="POST">
                                <input class="inputConnexion" type="text" name="modifierCommentaire" placeholder="<?= $commentaire['commentaire']?>"/>
                                <input class="button" type="submit" name="submit_update_commentaire" value="Modifier">
                            </form>
                        </div><?php
                    }
                }
        }

        if (isset($_SESSION['user'])){?>         
            <form action="index.php?action=posterCommentaireArbre&id=<?=$_SESSION['user']['id_utilisateur']?>&id_etre_vivant=<?=$id_etre_vivant?>" method="POST">
                <input class="inputConnexion" type="text" name="commentaire" placeholder="Votre commentaire">
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
$titre = 'Detail Arbre';
$contenu = ob_get_clean();

require "view/template.php";