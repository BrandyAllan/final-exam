<?php 
    $info_membre = get_loged_membre($_SESSION['email']);
    $liste_objet = get_objet_proprietaire($info_membre['id_membre']);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <section>
        <h1>Bonjour, <?= $info['nom'] ?> !</h1>
        <h2>Bienvenue sur le site d'emprunt.</h2>

        <br>
    </section>
    <section>
        <h2>Liste de vos objets</h2>
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
                        <td class="text-center"><img src="../assets/image/objets/<?= get_principal_image_object($liste_objet[$i]['id_objet']) ?>" alt="" width="50"></td>
                        <td><?= $liste_objet[$i]['nom_objet']; ?></td>
                        <td><?= $liste_objet[$i]['nom_categorie']; ?></td>
                        <td><?= get_nom_proprietaire_objet($liste_objet[$i]['id_membre']); ?></td>
                        <td><?= verifier_emprunt($liste_objet[$i]['id_objet']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <section>
        <a href="../modele/modele1.php?page=ajout-objet" class="btn btn-secondary">Ajouter un objet</a>
    </section>
</body>
</html>