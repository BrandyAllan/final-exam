<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include("../inc/fonction.php");
    $id_objet = $_POST['id_objet'];
    $id_membre = $_POST['id_membre'];
    $nb_jour = $_POST['nb_jour'];
    $date_emprunt = new DateTime();
    $date_retour = $date_emprunt -> modify("+$nb_jour days");

    $sql = "INSERT INTO s2_emprunt(id_objet, id_membre, date_emprunt, date_retour) VALUES(%s, %s, now(), '%s')";
    $sql = sprintf($sql, $id_objet, $id_membre, $date_retour->format('Y-m-d'));
    echo $sql;
    mysqli_query(dbconnect(), $sql);

    header('Location: ../modele/modele1.php?page=objet');

?>