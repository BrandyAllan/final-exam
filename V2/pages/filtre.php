<?php
    $liste_categorie = get_liste_categorie();
    if (isset($_POST['categorie']) && $_POST['categorie'] != 0) {
        $liste_filtrer = get_all_object_per_categorie($_POST['categorie']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
       <section class="p-3">
            <form action="../modele/modele1.php?page=filtre" method="post">
                <p class="mb-2">Choisissez une catégorie</p>
                <?php if (isset($_POST['categorie']) && $_POST['categorie'] == 0) { ?>
                    <p class = "text-danger">Veillez choisir une categorie</p>
                <?php } ?>
                <select name="categorie" id="categorie" class="form-select mb-3 w-50">
                    <option value="0">Catégories</option>
                    <?php for ($i = 0; $i < count($liste_categorie); $i++) { ?>
                        <option value="<?= $liste_categorie[$i]['id_categorie'] ?>">
                            <?= $liste_categorie[$i]['nom_categorie'] ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="submit" class="btn btn-success" value="Filtrer">
            </form>
        </section>
        <?php if (isset($_POST['categorie']) && $_POST['categorie'] != 0) { ?>
            <section>
                 <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom objet</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Propriétaire</th>
                            <th scope="col">Disponibilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($liste_filtrer); $i++) { ?>
                            <tr>
                                <td><?= $liste_filtrer[$i]['nom_objet']; ?></td>
                                <td><?= $liste_filtrer[$i]['nom_categorie']; ?></td>
                                <td><?= get_nom_proprietaire_objet($liste_filtrer[$i]['id_membre']); ?></td>
                                <td><?= verifier_emprunt($liste_filtrer[$i]['id_objet']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        <?php } ?>   
    </body>
</html>