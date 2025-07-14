<?php
    $liste_categorie = get_liste_categorie();
    $info_membre = get_loged_membre($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <section>
            <h1>Remplissez la formulaire pour un nouvel objet : </h1>
            <?php if(isset($_GET['success'])) { ?>
                <p class="text-success">Objet ajouté avec succés</p>
            <?php } ?>
            <form action="../traitement/traitement-ajout-objet.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_membre" value="<?= $info_membre['id_membre'] ?>">
                <p>
                    Insérer les images : 
                    <input type="file" name="image_objet[]" id="image_objet" multiple>
                </p>
                <p>Choisissez sa catégorie : 
                    <select name="categorie" id="categorie" class="form-select mb-3 w-50">
                        <option value="0">Catégories</option>
                        <?php for ($i = 0; $i < count($liste_categorie); $i++) { ?>
                            <option value="<?= $liste_categorie[$i]['id_categorie'] ?>">
                                <?= $liste_categorie[$i]['nom_categorie'] ?>
                            </option>
                        <?php } ?>
                    </select>                    
                </p>
                <p>Nom de l'objet : <input type="text" name="nom_objet"></p>
                <input type="submit" class="btn btn-success" value="Ajouter">
            </form>
        </section>
    </body>
</html>