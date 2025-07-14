<?php
    require("connexion.php");

    function get_all_member($email){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];

        $sql = "SELECT * 
        FROM Membres 
        WHERE IdMembre != %s AND IdMembre NOT IN 
        (SELECT * FROM v_amis_bloque)";
        $sql = sprintf($sql, $idMembre, $idMembre, $idMembre, $idMembre, $idMembre);
        $result = mysqli_query(dbconnect(), $sql);

        return $result;
    }

    function to_log($email, $mdp){
        $sql = "SELECT * FROM s2_membre WHERE email = '%s' AND mdp = '%s'";
        $sql = sprintf($sql, $email, $mdp);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }

    function verify_inscription($email){
        $sql = "SELECT * FROM s2_membre WHERE email = '%s'";
        $sql = sprintf($sql, $email);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }

    function verify_password($mdp, $mdpbis){
        if($mdp == $mdpbis){
            return true;
        }
        else{
            return false;
        }
    }

    function add_new_member($nom, $ddns, $genre, $email, $ville, $mdp, $image_profil){
        $sql = "INSERT INTO s2_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $nom, $ddns, $genre, $email, $ville, $mdp, $image_profil);
        mysqli_query(dbconnect(), $sql);
    }

    function get_loged_membre($email){
        $sql = "SELECT * FROM s2_membre WHERE email = '%s'";
        $sql = sprintf($sql, $email);
        $result = mysqli_query(dbconnect(), $sql);
        $donnee = mysqli_fetch_assoc($result);
        return $donnee;
    }

    function getIdLoged($email){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];
        return $idMembre;
    }

    function get_membre_info($id){
        $sql = "SELECT * FROM Membres WHERE IdMembre = '%s'";
        $sql = sprintf($sql, $id);
        $result = mysqli_query(dbconnect(), $sql);
        $donnee = mysqli_fetch_assoc($result);
        return $donnee;
    }

    function get_all_object(){

    }
?>