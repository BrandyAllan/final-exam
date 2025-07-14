<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $idMembreBlocke = $_GET['idBlocke'];

    to_blocke($_SESSION['email'], $idMembreBlocke);

    header('Location: ../pages/liste.php');


?>