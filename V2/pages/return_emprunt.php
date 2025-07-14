<?php
$id = $_GET['id_emprunt'];
?>
<form action="../traitement/traitement_return_emprunt.php" method="POST" >
    <p class="mb-2">Confirmer l'état de l'objet</p>
    <input type="hidden" name="id" value="<?= $id ?>">
    <select name="etat" id="etat" class="form-select mb-3 w-50">
        <option value="0">OK</option>
        <option value="1">Abimé</option>
    </select>
    <input type="submit" class="btn btn-success" value="Valider">
</form>