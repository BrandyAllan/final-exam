<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    
    $idPub = $_POST['idPub'];
    $coms = $_POST['commentaire'];

    add_comment($idPub, $coms, $_SESSION['email']);
    
    $header = "Location: ../pages/commentaire.php?idPub=%s";
    $header = sprintf($header, $idPub);
    //echo $header;
    header($header);
?>