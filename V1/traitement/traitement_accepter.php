<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $email = $_SESSION['email'];
    $idMembreSender = $_GET['idSender'];

    accept_friend_request($email, $idMembreSender);

    $header = "Location: ../pages/demande.php?nb=%s";
    $header = sprintf($header, get_number_friends_request($_SESSION['email']));
    //echo $header;
    header($header);
    
?>