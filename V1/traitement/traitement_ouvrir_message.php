<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    require("../inc/fonction.php");
    $infoMb1 = get_loged_membre($_SESSION['email']);
    $idMembre1 = $infoMb1['IdMembre'];
    $idMembre2 = $_GET['id'];
    
    if(verify_message($idMembre1, $idMembre2) < 1){
        $idconv = create_new_conversation($idMembre1, $idMembre2);
        $header = "Location: ../pages/message.php?id=%s&idconv=%s";
        $header = sprintf($header, $idMembre2, $idconv);
        echo $header;
        header($header);
    }
    else{
        $idconv = get_idconv($idMembre1, $idMembre2);
        $header = "Location: ../pages/message.php?id=%s&idconv=%s";
        $header = sprintf($header, $idMembre2, $idconv);
        echo $header;
        header($header);
    }

?>