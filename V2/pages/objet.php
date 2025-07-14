<?php
    $liste_objet = get_all_object();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
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
    </body>
</html>