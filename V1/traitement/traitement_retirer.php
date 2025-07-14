<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $idMembre = $_GET['idMb2'];

    to_remove_friend($_SESSION['email'], $idMembre);

    header('Location: ../pages/amis.php');


?>