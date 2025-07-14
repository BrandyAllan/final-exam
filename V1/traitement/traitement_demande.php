<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $email = $_SESSION['email'];
    $idMembreReceiver = $_GET['idMb2'];

    send_friend_request($email, $idMembreReceiver);

    if(!isset($_SESSION['added'])){
        $_SESSION['added'] = array();
        $_SESSION['added'][] = $idMembreReceiver;
    }
    else{
        $_SESSION['added'][] = $idMembreReceiver;
    }

    $header = "Location: ../pages/liste.php";
    header($header);
    
?>