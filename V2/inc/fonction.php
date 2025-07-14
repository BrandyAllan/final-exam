<?php
    require("connexion.php");

    function get_all_member(){
        $sql = "SELECT * 
        FROM s2_membre";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();

        while($data = mysqli_fetch_assoc($result)) { 
            $ret[] = $data;
        }

        return $ret;
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
        $sql = "SELECT * 
        FROM s2_objet o
        JOIN s2_membre m ON m.id_membre = o.id_membre
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

    function get_object_pour_emprunt($id){
        $sql = "SELECT * FROM v_s2_objet 
                WHERE id_objet = $id";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = $data = mysqli_fetch_assoc($result);

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
            if ($date <= $now) {
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
                WHERE id_membre = $id_membre
                ORDER BY nom_categorie";
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

    function add_new_object($nom_objet, $id_categorie, $id_membre, $filenames) {
        $sql = "INSERT INTO s2_objet(nom_objet, id_categorie, id_membre) VALUES('%s', %s, %s)";
        $sql = sprintf($sql, $nom_objet, $id_categorie, $id_membre);
        mysqli_query(dbconnect(), $sql);

        $id_objet = mysqli_insert_id(dbconnect());
        $sql = "INSERT INTO s2_image_objet(id_objet, nom_image) VALUES(%s, '%s')";
        $sql = sprintf($sql, $id_objet, $filenames);
        mysqli_query(dbconnect(), $sql);
    }

    function get_principal_image_object($id_objet) {
        $sql = "SELECT * FROM s2_image_objet WHERE id_objet = $id_objet";
        $result = mysqli_query(dbconnect(), $sql);
        if(mysqli_num_rows($result) < 1) {
            return "default.jpg";
        }
        $data = mysqli_fetch_assoc($result);
        if($data['nom_image'] == NULL) {
            return "default.jpg";
        }
        $nom_image = explode(";", $data['nom_image']);
        return $nom_image[0];
    }

    function get_all_image_object($id_objet) {
        $sql = "SELECT * FROM s2_image_objet WHERE id_objet = $id_objet";
        $result = mysqli_query(dbconnect(), $sql);
        $data = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) < 1) {
            $nom_image[] = "default.jpg";
            return $nom_image;
        }
        if($data['nom_image'] == NULL) {
            $nom_image[] = "default.jpg";
            return $nom_image;
        }
        $nom_image = explode(";", $data['nom_image']);
        return $nom_image;
    }

    function search_without_disponible($id_categorie, $nom_objet) {
        $sql = "SELECT * FROM v_s2_objet 
        WHERE 1 = 1";
        if($id_categorie != 0) {
            $sql = $sql . " AND id_categorie = $id_categorie";
        }
        if($nom_objet != "") {
            $sql = $sql . " AND nom_objet LIKE '%$nom_objet%'";
        }
        $result = mysqli_query(dbconnect(), $sql);
        $recherche = array();
        while ($data = mysqli_fetch_assoc($result)) {
            $recherche[] = $data;
        }
        return $recherche;
    }

    function search_disponible($id_categorie, $nom_objet) {
        $sql = "SELECT * FROM v_s2_objet 
        WHERE 1 = 1";
        if($id_categorie != 0) {
            $sql = $sql . " AND id_categorie = $id_categorie";
        }
        if($nom_objet != "") {
            $sql = $sql . " AND nom_objet LIKE '%$nom_objet%'";
        }
        $result = mysqli_query(dbconnect(), $sql);
        $recherche = array();
        while ($data = mysqli_fetch_assoc($result)) {
            $verify = verifier_emprunt($data['id_objet']);
            if($verify == "DISPONIBLE"){

                $recherche[] = $data;
            } 
        }
        return $recherche;
    } 

    function get_emprunt_membre($id_membre){
        $sql = "SELECT * FROM s2_emprunt WHERE id_membre = $id_membre";
        $result = mysqli_query(dbconnect(), $sql);
        $ret = array();
        while ($data = mysqli_fetch_assoc($result)) {
            $ret[] = $data;
        }

        return $ret;      
    }
?>