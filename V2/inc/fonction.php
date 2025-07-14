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
        $sql = "SELECT * FROM v_s2_objet";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }

        return $ret;
    }

    function get_object_per_id($id){
        $sql = "SELECT * FROM v_s2_objet
                WHERE id_objet = $id";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }

        return $ret;
    }

    function get_all_object_per_categorie($id){
        $sql = "SELECT * FROM v_s2_objet 
                WHERE id_categorie = $id";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }

        return $ret;
    }

    function get_image_objet($id){
        $sql = "SELECT * FROM s2_image_objet
                WHERE id_objet = $id";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }
        return $ret;
    }

    function verifier_emprunt($id_objet) {
        $sql = "SELECT *
        FROM s2_emprunt
        WHERE id_objet = $id_objet";
        $result = mysqli_query(dbconnect(), $sql);

        if(mysqli_num_rows($result) < 1) {
            return "DISPONIBLE";
        } else {
            $data = mysqli_fetch_assoc($result);
            $now = new DateTime();
            $date = new DateTime($data['date_retour']);
            if ($date < $now) {
                return "DISPONIBLE";
            }
            $ret = "A partir de %s";
            $date = date("d M Y", strtotime($data['date_retour']));
            $ret = sprintf($ret, $date);
            return $ret;
        }
    }

    function get_nom_proprietaire_objet($id_membre) {
        $sql = "SELECT * FROM s2_membre WHERE id_membre = $id_membre";
        $result = mysqli_query(dbconnect(), $sql);
        $data = mysqli_fetch_assoc($result);

        return $data['nom'];
    }

    function get_liste_categorie() {
        $sql = "SELECT * FROM s2_categorie_objet";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();
        while ($data = mysqli_fetch_assoc($result)) {
            $ret[] = $data;
        }

        return $ret;
    }

    function get_objet_proprietaire($id_membre) {
        $sql = "SELECT * FROM v_s2_objet 
                WHERE id_membre = $id_membre";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }

        return $ret;
    }

    function get_objet_emprunt_history($id){
        $sql = "SELECT * FROM s2_emprunt 
                WHERE id_objet = $id";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();
        while ($data = mysqli_fetch_assoc($result)) {
            $ret[] = $data;
        }

        return $ret;
    }
?>