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
    <body>
        <header>
            <h1>Se connecter</h1>
        </header>
        <main>
            <div class="log">
                <form action="../traitement/traitement-login.php" method="post">
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="error">Email ou mot de passe incorect</p>
                    <?php } ?>
                    <p>Email : <input type="text" name="email"></p>
                    <p>Mot de passe : <input type="password" name="mdp"></p>
                    <p><input type="submit" value="Se connecter"></p>
                </form>
                <p>Vous n'avez pas de compte ? <a href="inscription.php" class="inscri">S'inscrire</a></p>
            </div>
        </main>
    </body>
</html>