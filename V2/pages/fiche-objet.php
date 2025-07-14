<?php
$info_objet = get_object_per_id($_GET['id_objet']);
$history_emprunt = get_objet_emprunt_history($_GET['id_objet']);
$images = get_all_image_object($_GET['id_objet']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <section>
        <div id="mainCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/image/objets<?= $images[0] ?>.jpeg" class="d-block w-100" alt="Room 1">
            </div>
            <?php for ($i = 1; $i < count($images); $i++) { ?>
                <div class="carousel-item">
                    <img src="../assets/image/objets<?= $images[$i] ?>.jpeg" class="d-block w-100" alt="Room 2">
                </div>  
            <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="d-flex gallery-thumbs">
            <?php for ($i = 0; $i < count($images); $i++) { ?>
                <img src="../assets/image/objets<?= $images[$i] ?>.jpeg" data-bs-target="#mainCarousel" data-bs-slide-to="<?= $i ?>" class="me-2">               
            <?php } ?>
        </div>
        <p><?= $info_objet[0]['nom_objet'] ?> de <?= $info_objet[0]['nom'] ?></p>
        <article>
            <h3>Historique d'emprunt</h3>
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