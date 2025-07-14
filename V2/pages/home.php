<?php 
    $info_membre = get_loged_membre($_SESSION['email']);
    $liste_objet = get_objet_proprietaire($info_membre['id_membre']);
?>
<!DOCTYPE html>
<html lang="en">
<body class="bg-light">
    <div class="container py-5">

        <section class="mb-5 text-center">
            <h1 class="text-primary">Bonjour, <?= $info['nom'] ?> !</h1>
            <h2 class="text-muted">Bienvenue sur le site d'emprunt.</h2>
        </section>

        <section class="mb-5">
            <h2 class="mb-4">Liste de vos objets</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col">Nom objet</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Propriétaire</th>
                            <th scope="col">Disponibilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($liste_objet); $i++) { ?>
                            <tr>
                                <td class="text-center">
                                    <img src="../assets/image/objets/<?= get_principal_image_object($liste_objet[$i]['id_objet']) ?>"
                                         alt="objet"
                                         width="50"
                                         class="img-thumbnail">
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

        <section class="text-center">
            <a href="../modele/modele1.php?page=ajout-objet" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Ajouter un objet
            </a>
        </section>

    </div>
</body>

</html>