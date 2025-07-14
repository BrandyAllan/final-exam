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
        $sql = "SELECT * FROM Membres WHERE Email = '%s' AND Motdepasse = '%s'";
        $sql = sprintf($sql, $email, $mdp);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }

    function verify_inscription($email){
        $sql = "SELECT * FROM Membres WHERE Email = '%s'";
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

    function add_new_member($email, $mdp, $nom, $ddns){
        $sql = "INSERT INTO Membres (Email, Motdepasse, Nom, DateNaissance) VALUES ('%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $email, $mdp, $nom, $ddns);
        mysqli_query(dbconnect(), $sql);
    }

    function get_loged_membre($email){
        $sql = "SELECT * FROM Membres WHERE Email = '%s'";
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

    function to_blocke($email, $idMembreBlocke){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];

        $sql = "SELECT * FROM Amis WHERE (IdMembre1 = %s OR IdMembre2 = %s) AND (IdMembre1 = %s OR IdMembre2 = %s)";
        $sql = sprintf($sql, $idMembre,$idMembre, $idMembreBlocke, $idMembreBlocke);
        $resultat = mysqli_query(dbconnect(), $sql);
        if(mysqli_num_rows($resultat) < 1){
            $sql = "INSERT INTO Amis (IdMembre1, IdMembre2, Bloque) VALUES (%s, %s, 'Bloque')";
            $sql = sprintf($sql, $idMembre, $idMembreBlocke);
            mysqli_query(dbconnect(), $sql);
        }
        else{
            $sql = "UPDATE Amis SET Bloque = 'Bloque' WHERE (IdMembre1 = %s OR IdMembre2 = %s) AND (IdMembre1 = %s OR IdMembre2 = %s)";
            $sql = sprintf($sql, $idMembre,$idMembre, $idMembreBlocke, $idMembreBlocke);
            mysqli_query(dbconnect(), $sql);
        }
    }

    function get_all_publications(){
        $sql_pub = "SELECT * FROM v_publication_simple";
        $publication = mysqli_query(dbconnect(), $sql_pub);
        $all_pub = array();
        while($pub = mysqli_fetch_assoc($publication)){
            $all_pub[] = $pub;
        }
        return $all_pub;
    }

    function get_all_publications_bis($email){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];
        $sql_pub = "SELECT
            *
        FROM
            v_publication_simple v
        WHERE
            v.IdMembre NOT IN (
                SELECT
                    *
                FROM
                    v_amis_bloque
                
            ) OR v.IdMembre = %s";
        $sql_pub = sprintf($sql_pub, $idMembre);
        $publication = mysqli_query(dbconnect(), $sql_pub);
        $all_pub = array();
        while($pub = mysqli_fetch_assoc($publication)){
            $all_pub[] = $pub;
        }
        return $all_pub;
    }

    function get_one_pub($idPub){
        $sql_pub = "SELECT * FROM v_publication_simple v WHERE v.IdPub = '%s'";
        $sql_pub = sprintf($sql_pub, $idPub);
        $publication = mysqli_query(dbconnect(), $sql_pub);
        $one_pub = array();
        while($pub = mysqli_fetch_assoc($publication)){
            $one_pub[] = $pub;
        }
        return $one_pub;
    }

    function get_comment_pub($idPub){
        $sql_com = "SELECT * FROM v_commentaire v WHERE v.IdPub = '%s'";
        $sql_com = sprintf($sql_com, $idPub);
        $commentaire = mysqli_query(dbconnect(), $sql_com);
        $all_coms = array();
        while($coms = mysqli_fetch_assoc($commentaire)){
            $all_coms[] = $coms;
        }
        return $all_coms;
    }

    function get_nb_reaction($idPub){
        $sql = "SELECT * FROM Reaction WHERE IdPublication = %s";
        $sql = sprintf($sql, $idPub);
        $result = mysqli_query(dbconnect(), $sql);
        if(mysqli_num_rows($result) < 1){
            return 0;
        }
        else{
            return mysqli_num_rows($result);
        }
    }

    function add_comment($idPub, $coms, $email){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];
        $sql = "INSERT INTO Commentaire (IdPublication, TexteCommentaire, IdMembre) VALUES ('%s', '%s', '%s')";
        $sql = sprintf($sql, $idPub, $coms, $idMembre);
        mysqli_query(dbconnect(), $sql);
    }

    function to_react($idPub, $email){
        $donnee = get_loged_membre($email);
        $idMembre = $donnee['IdMembre'];
        $sql = "SELECT * FROM Reaction WHERE IdPublication = '%s' AND IdMembre = '%s'";
        $sql = sprintf($sql, $idPub, $idMembre);
        $result = mysqli_query(dbconnect(), $sql);
        if(mysqli_num_rows($result) > 0){
            $sql_deletereact = "DELETE FROM Reaction WHERE IdPublication = '%s' AND IdMembre = '%s'";
            $sql_deletereact = sprintf($sql_deletereact, $idPub, $idMembre);
            mysqli_query(dbconnect(), $sql_deletereact);
        }
        else{
            $sql_addreact = "INSERT INTO Reaction VALUES (%s, %s)";
            $sql_addreact = sprintf($sql_addreact, $idPub, $idMembre);
            mysqli_query(dbconnect(), $sql_addreact);
        }
    }

    function to_post($pub, $email){
        $donnee = get_loged_membre($email);
        $idMembres = $donnee['IdMembre'];
        $sql = "INSERT INTO Publication (TextePublication, IdMembre) VALUES ('%s', '%s')";
        $sql = sprintf($sql, $pub, $idMembres);
        mysqli_query(dbconnect(), $sql);

    }

    function to_post_with_files($pub, $file, $email){
        $donnee = get_loged_membre($email);
        $idMembres = $donnee['IdMembre'];
        $sql = "INSERT INTO Publication (TextePublication, IdMembre, Fichiers) VALUES ('%s', '%s', '%s')";
        $sql = sprintf($sql, $pub, $idMembres, $file);
        mysqli_query(dbconnect(), $sql);

    }

    function send_friend_request($email, $idMembreReceiver){
        $donnee = get_loged_membre($email);
        $idMembreSender = $donnee['IdMembre'];

        $sql = "INSERT INTO Amis (IdMembre1, IdMembre2, DateHeureDemande) VALUES ('%s', '%s', now())";
        $sql = sprintf($sql, $idMembreSender, $idMembreReceiver);
        mysqli_query(dbconnect(), $sql);

        $sql = "INSERT INTO Demande VALUES ('%s', '%s')";
        $sql = sprintf($sql, $idMembreReceiver, $idMembreSender);
        mysqli_query(dbconnect(), $sql);
    }

    function get_friend_request_list($email){
        $donnees = get_loged_membre($email);
        $idMembre = $donnees['IdMembre'];
        $sql1 = "SELECT * FROM v_detail_demande v WHERE v.IdMb = '%s'";
        $sql1 = sprintf($sql1, $idMembre);
        $result = mysqli_query(dbconnect(), $sql1);

        return $result;
    }

    function accept_friend_request($email, $idMembreSender){
        $donne = get_loged_membre($email);
        $idMembreReceiver = $donne['IdMembre'];

        $sql = "UPDATE Amis SET DateHeureAcceptation = now() WHERE IdMembre1 = %s AND IdMembre2 = %s";
        $sql = sprintf($sql, $idMembreSender, $idMembreReceiver);

        $sql_delete = "DELETE FROM Demande WHERE IdMembre1 = %s AND IdMembre2 = %s";
        $sql_delete = sprintf($sql_delete, $idMembreReceiver, $idMembreSender);

        mysqli_query(dbconnect(), $sql);
        mysqli_query(dbconnect(), $sql_delete);
    }

    function get_friends_list($email){
        $donnees = get_loged_membre($email);
        $sql = "SELECT
            *
        FROM
            v_liste_amis v
        WHERE
            v.IdMembre != %s
            AND (
                v.IdMembre1 = %s
                OR v.IdMembre2 = %s
            )";
        $sql = sprintf($sql, $donnees['IdMembre'], $donnees['IdMembre'], $donnees['IdMembre']);
        $result = mysqli_query(dbconnect(), $sql);

        return $result;
    }

    function get_number_friends_request($email){
        $donnees = get_loged_membre($email);
        $idMembre = $donnees['IdMembre'];
        $sql1 = "SELECT * FROM v_detail_demande v WHERE v.IdMb = '%s'";
        $sql1 = sprintf($sql1, $idMembre);
        $result = mysqli_query(dbconnect(), $sql1);

        return mysqli_num_rows($result);
    }

    function verify_friend_situation($email, $nom){
        $donnees = get_loged_membre($email);
        $sql = "SELECT v.Nom FROM v_liste_amis v WHERE v.IdMembre1 = %s OR v.IdMembre2 = %s";
        $sql = sprintf($sql, $donnees['IdMembre'], $donnees['IdMembre']);
        $sql1 = "SELECT * FROM Membres WHERE Nom = '%s' AND Nom IN (%s)";
        $sql1 = sprintf($sql1, $nom, $sql);
        $result = mysqli_query(dbconnect(), $sql1);

        return mysqli_num_rows($result);
    }

    function decline_invitation($email, $idMembreSender){
        $donne = get_loged_membre($email);
        $idMembreReceiver = $donne['IdMembre'];
    
        $sql = "DELETE FROM Demande WHERE IdMembre1 = %s AND IdMembre2 = %s";
        $sql = sprintf($sql, $idMembreReceiver, $idMembreSender);
        mysqli_query(dbconnect(), $sql);
    
        $sql = "DELETE FROM Amis WHERE IdMembre1 = %s AND IdMembre2 = %s";
        $sql = sprintf($sql, $idMembreSender, $idMembreReceiver);
        mysqli_query(dbconnect(), $sql);
    }

    function to_remove_friend($email, $idMembre2){
        $donne = get_loged_membre($email);
        $idMembreLoged = $donne['IdMembre'];

        $sql = "DELETE FROM Amis WHERE (IdMembre1 = %s AND IdMembre2 = %s) OR (IdMembre1 = %s AND IdMembre2 = %s)";
        $sql = sprintf($sql, $idMembreLoged, $idMembre2, $idMembre2, $idMembreLoged);
        mysqli_query(dbconnect(), $sql);
    }

    function verify_message($id1, $id2){
        $sql = "SELECT * FROM Conversation WHERE (IdMembre1 = %s AND IdMembre2 = %s) OR (IdMembre1 = %s AND IdMembre2 = %s)";
        $sql = sprintf($sql, $id1, $id2, $id2, $id1);
        $result = mysqli_query(dbconnect(), $sql);

        return mysqli_num_rows($result);
    }

    function create_new_conversation($id1, $id2){
        $sql = "INSERT INTO Conversation (date_creation, IdMembre1, IdMembre2) VALUES (now(), %s, %s)";
        $sql = sprintf($sql, $id1, $id2);
        mysqli_query(dbconnect(), $sql);
        $idconv = mysqli_insert_id(dbconnect());

        return $idconv;
    }
    function get_idconv($id1, $id2){
        $sql = "SELECT * FROM Conversation WHERE (IdMembre1 = %s AND IdMembre2 = %s) OR (IdMembre1 = %s AND IdMembre2 = %s)";
        $sql = sprintf($sql, $id1, $id2, $id2, $id1);
        $result = mysqli_query(dbconnect(), $sql);
        $donnee = mysqli_fetch_assoc($result);

        return $donnee['IdConversation'];
    }

    function send_message($id, $idconv, $contenu){
        $sql = "INSERT INTO Message (IdConversation, IdAuteur, contenu_message, date_envoi) VALUES (%s, %s, '%s', now())";
        $sql = sprintf($sql, $idconv, $id, $contenu);
        mysqli_query(dbconnect(), $sql);
    }

    function get_messages($idconv, $id1, $id2){
        $sql = "SELECT * FROM Message WHERE IdConversation = %s AND (IdAuteur = %s OR IdAuteur = %s) ORDER BY date_envoi DESC";
        $sql = sprintf($sql, $idconv, $id1, $id2);
        $result = mysqli_query(dbconnect(), $sql);

        return $result;
    }

?>