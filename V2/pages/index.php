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

        <header class="text-center py-4 bg-primary text-white">
            <h1>Se connecter</h1>
        </header>

        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php if(isset($_GET['error'])) { ?>
                                    <div class="alert alert-danger text-center">
                                        Email ou mot de passe incorrect
                                    </div>
                                <?php } ?>

                                <form action="../traitement/traitement-login.php" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="text" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mdp" class="form-label">Mot de passe :</label>
                                        <input type="password" class="form-control" name="mdp" id="mdp" required>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Se connecter</button>
                                    </div>
                                </form>

                                <p class="mt-3 text-center">
                                    Vous n'avez pas de compte ?
                                    <a href="inscription.php" class="text-decoration-none">S'inscrire</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>