<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if(isset($_GET['page'])) {
        $title = $_GET['page'];
        $include = "../pages/$title.php";
    } else {
        $include = "../pages/index.php";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
         <body class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container">
                    <a class="navbar-brand" href="modele1.php?page=department">Emprunt</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="?page=index">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=filtre">Filtre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=objet">Liste objets</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-fill container my-4">
            <?php include($include); ?>
        </main>

        <footer class="bg-light text-center py-3 mt-auto border-top">
            <div class="container">
                <span class="text-muted">&copy; <?= date('Y') ?> Examen S2. Tous droits réservés.</span>
            </div>
        </footer>
    </body>
    </body>
</html>