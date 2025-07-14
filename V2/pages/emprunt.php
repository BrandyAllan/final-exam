<?php

    $id_objet = $_GET['id_objet'];
    $info_object = get_object_pour_emprunt($id_objet);
    $info_membre = get_loged_membre($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <section>
            <h2>Formulaire d'emprunt pour :</h2>
            <p>Nom de l'objet : <?= $info_object['nom_objet'] ?></p>
            <p>Catégorie : <?= $info_object['nom_categorie'] ?></p>

            <form action="../traitement/traitement-emprunt.php" method="post">
                <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                <input type="hidden" name="id_membre" value="<?= $info_membre['id_membre'] ?>">
                <p>Nombre de jour : <input type="number" name="nb_jour"></p>
                <input type="submit" class="btn btn-success" value="Filtrer">
            </form>
        </section>
    </body>
</html>