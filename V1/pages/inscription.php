<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FAKEBOOK</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <header>
            <h1>Inscrption</h1>
        </header>
        <main>
            <div class="inscription">
                <form action="../traitement/traitement-inscription.php" method="post">
                    <p>Photo de profil : <input type="file" name = "profil"></p>
                    <p>Nom : <input type="text" name="nom"></p>
                    <p>Date de naissance : <input type="date" name="ddns"></p>
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="error">Votre email a déjà été utilisé</p>
                    <?php } ?>
                    <p>Genre : 
                        <select name = "sexe">
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                    </p>
                    <p>Email : <input type="text" name="email"></p>
                    <p>Ville : <input type="text" name = "ville"></p>
                    <p>Mot de passe : <input type="password" name="mdp"></p>
                    <?php if(isset($_GET['errormdp'])) { ?>
                        <p>Veillez confirmer votre mot de passe</p>
                    <?php } ?>
                    <p>Confirmer mot de passe : <input type="password" name="mdpbis"></p>
                    <p><input type="submit" value="S'inscrire"></p>
                </form>
                <p>Vous avez déjà un compte ? <a href="../modele/modele1.php?page=index" class="inscri">Se connecter</a></p>
            </div>
        </main>
    </body>
</html>