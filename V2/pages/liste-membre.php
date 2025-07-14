<?php
$all_membre = get_all_member($_SESSION['email']);
?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($all_membre); $i++) { ?>
                    <tr>
                        <td><a href="../modele/modele1.php?page=fiche-membre&id_membre=<?= $all_membre[$i]['id_membre'] ?>"><i class="bi bi-box-seam"></i></a></td>
                        <td><?= $all_membre[$i]['nom'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>