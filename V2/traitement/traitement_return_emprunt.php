<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");

    $id = $_POST['id'];
    $etat = $_POST['etat'];
    $sql = "INSERT INTO s2_return (id_emprunt, etat) VALUES($id, $etat)";
    $req = mysqli_query(dbconnect(), $sql);

    header('Location: ../modele/modele1.php?page=liste-membre');

?>