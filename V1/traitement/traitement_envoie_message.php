<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    require("../inc/fonction.php");
    $infoMb1 = get_loged_membre($_SESSION['email']);
    $idMembre1 = $infoMb1['IdMembre'];
    $idMembre2 = $_POST['id'];
    $idconv = $_POST['idconv'];
    $contenu = $_POST['contenu'];

    send_message($idMembre1, $idconv, $contenu);
    $header = "Location: ../pages/message.php?id=%s&idconv=%s";
    $header = sprintf($header, $idMembre2, $idconv);
    header($header);

?>