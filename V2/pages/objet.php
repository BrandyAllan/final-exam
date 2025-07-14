<?php
    $liste_objet = get_all_object();
    $liste_categorie = get_liste_categorie();
    $id_categorie = 0;
    $nom_objet = "";
    
    if(!isset($_POST['disponible']) && (isset($_POST['categorie']) || isset($_POST['nom_objet']))) {
        if(isset($_POST['categorie'])) {
            $id_categorie = $_POST['categorie'];
        }
        if(isset($_POST['nom_objet'])) {
            $nom_objet = $_POST['nom_objet'];
        }
        $recherche = search_without_disponible($id_categorie, $nom_objet);
    }
    if(isset($_POST['disponible'])) {
        echo $_POST['disponible'];
        if(isset($_POST['categorie'])) {
            $id_categorie = $_POST['categorie'];
        }
        if(isset($_POST['nom_objet'])) {
            $nom_objet = $_POST['nom_objet'];
        }
        $recherche = search_disponible($id_categorie, $nom_objet);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body class="bg-light">

        <section class="container py-4">
            <h3 class="mb-4">🔍 Rechercher un objet</h3>
            <form action="../modele/modele1.php?page=objet" method="post" class="bg-white p-4 rounded shadow-sm">
                <div class="mb-3">
                    <label for="categorie" class="form-label">Choisissez une catégorie</label>

                    <?php if (isset($_POST['categorie']) && $_POST['categorie'] == 0) { ?>
                        <div class="text-danger mb-2">Veuillez choisir une catégorie</div>
                    <?php } ?>

                    <select name="categorie" id="categorie" class="form-select w-50">
                        <option value="0">Catégories</option>
                        <?php for ($i = 0; $i < count($liste_categorie); $i++) { ?>
                            <option value="<?= $liste_categorie[$i]['id_categorie'] ?>">
                                <?= $liste_categorie[$i]['nom_categorie'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 w-50">
                    <label for="nom_objet" class="form-label">Nom de l'objet</label>
                    <input type="text" id="nom_objet" name="nom_objet" class="form-control">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" value="1" name="disponible" id="disponible">
                    <label class="form-check-label" for="disponible">Afficher uniquement les objets disponibles</label>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </form>
        </section>

        <section class="container mt-5">
            <h4 class="mb-3">📦 Liste</h4>
            <div class="table-responsive">
                <?php if(!isset($_POST['disponible']) && (isset($_POST['categorie']) || isset($_POST['nom_objet']))) { ?>
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
                        <?php for($i = 0; $i < count($recherche); $i++) { ?>
                            <tr>
                                <td class="text-center">
                                    <a href="../modele/modele1.php?page=fiche-objet&id_objet=<?= $recherche[$i]['id_objet'] ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-box-seam"></i>
                                    </a>
                                </td>
                                <td><?= $recherche[$i]['nom_objet']; ?></td>
                                <td><?= $recherche[$i]['nom_categorie']; ?></td>
                                <td><?= get_nom_proprietaire_objet($recherche[$i]['id_membre']); ?></td>
                                <td><?= verifier_emprunt($recherche[$i]['id_objet']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>

                <?php if(!isset($_POST['disponible']) && !isset($_POST['categorie']) && !isset($_POST['nom_objet'])) { ?>

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
                <?php } ?>

            </div>
        </section>

    </body>

</html>