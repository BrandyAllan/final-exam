<?php
$info_objet = get_object_per_id($_GET['id_objet']);
$history_emprunt = get_objet_emprunt_history($_GET['id_objet']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <section>
        <article>
            <h3>Histprique d'emprunt</h3>
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date d'emprunt</th>
                            <th scope="col">Date de retour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($history_emprunt); $i++) { ?>
                            <tr>
                                <td><?= $history_emprunt[$i]['date_emprunt']; ?></td>
                                <td><?= $history_emprunt[$i]['date_retour']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </article>
    </section>
</body>
</html>