<?php
    $liste_categorie = get_liste_categorie();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <section>
            <form action="../modele/modele1.php?page=filtre" method="post">
                <p></p>
                <select name="categorie" id="categorie"></select>
            </form>
        </section>
    </body>
</html>