<?php
    $liste_objet = get_all_object();
    $liste_categorie = get_liste_categorie();

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
            <h3>Rechercher</h3>
            <form action="../modele/modele1.php?page=filtre" method="post">
                <p class="mb-2">Choisissez une catégorie
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
                </p>
                <input type="text">
                <input type="submit" class="btn btn-success" value="Rechercher">
            </form>
        </section>
        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Nom objet</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Propriétaire</th>
                        <th scope="col">Disponibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($liste_objet); $i++) { ?>
                        <tr>
                            <td><a href="../modele/modele1.php?page=fiche-objet&id_objet=<?= $liste_objet[$i]['id_objet'] ?>"><i class="bi bi-box-seam"></i></a></td>
                            <td><?= $liste_objet[$i]['nom_objet']; ?></td>
                            <td><?= $liste_objet[$i]['nom_categorie']; ?></td>
                            <td><?= get_nom_proprietaire_objet($liste_objet[$i]['id_membre']); ?></td>
                            <td><?= verifier_emprunt($liste_objet[$i]['id_objet']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </body>
</html>