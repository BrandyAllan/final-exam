<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    if(to_log($email, $mdp) < 1){
        header('Location: ../modele/modele1.php?page=index&error=0');
        exit;
    }
    $_SESSION['email'] = $email;
    //echo "Connexion réussie";
    header('Location: ../modele/modele1.php?page=home');
?>