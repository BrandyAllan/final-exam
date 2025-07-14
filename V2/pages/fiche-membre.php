<?php
$id = $_GET['id_membre'];
$liste_objet = get_objet_proprietaire($id);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body class="bg-light">

        <section class="container mt-5">
            <h4 class="mb-3">📦 Liste</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Voir</th>
                            <th scope="col">Nom objet</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Propriétaire</th>
                            <th scope="col">Disponibilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($liste_objet); $i++) { ?>
                            <tr>
                                <td class="text-center">
                                    <a href="../modele/modele1.php?page=fiche-objet&id_objet=<?= $liste_objet[$i]['id_objet'] ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-box-seam"></i>
                                    </a>
                                </td>
                                <td><?= $liste_objet[$i]['nom_objet']; ?></td>
                                <td><?= $liste_objet[$i]['nom_categorie']; ?></td>
                                <td><?= get_nom_proprietaire_objet($liste_objet[$i]['id_membre']); ?></td>
                                <td><?= verifier_emprunt($liste_objet[$i]['id_objet']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

    </body>

</html>