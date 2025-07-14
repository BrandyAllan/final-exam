<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $idPub = $_GET['idPub'];
    to_react($idPub, $_SESSION['email']);
    header('Location: ../pages/home.php');
?>