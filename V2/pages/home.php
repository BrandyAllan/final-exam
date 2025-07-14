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

        <section class="text-center">
            <a href="../modele/modele1.php?page=ajout-objet" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Ajouter un objet
            </a>
        </section>

    </div>
</body>

</html>