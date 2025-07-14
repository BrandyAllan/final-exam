<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emprunt</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="bg-light">

        <header class="bg-success text-white text-center py-4">
            <h1>Inscription</h1>
        </header>

        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="../traitement/traitement-inscription.php" method="post" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label for="profil" class="form-label">Photo de profil</label>
                                        <input type="file" name="profil" id="profil" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ddns" class="form-label">Date de naissance</label>
                                        <input type="date" name="ddns" id="ddns" class="form-control" required>
                                    </div>

                                    <?php if (isset($_GET['error'])) { ?>
                                        <div class="alert alert-danger">Votre email a déjà été utilisé</div>
                                    <?php } ?>

                                    <div class="mb-3">
                                        <label for="sexe" class="form-label">Genre</label>
                                        <select name="sexe" id="sexe" class="form-select" required>
                                            <option value="">Sexe</option>
                                            <option value="M">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ville" class="form-label">Ville</label>
                                        <input type="text" name="ville" id="ville" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="mdp" class="form-label">Mot de passe</label>
                                        <input type="password" name="mdp" id="mdp" class="form-control" required>
                                    </div>

                                    <?php if (isset($_GET['errormdp'])) { ?>
                                        <div class="alert alert-warning">Veuillez confirmer votre mot de passe</div>
                                    <?php } ?>

                                    <div class="mb-3">
                                        <label for="mdpbis" class="form-label">Confirmer mot de passe</label>
                                        <input type="password" name="mdpbis" id="mdpbis" class="form-control" required>
                                    </div>

                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-success">S'inscrire</button>
                                    </div>

                                </form>

                                <p class="text-center">
                                    Vous avez déjà un compte ?
                                    <a href="index.php" class="text-decoration-none">Se connecter</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>