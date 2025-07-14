<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $nom_objet = $_POST['nom_objet'];
    $nom_objet = mysqli_real_escape_string(dbconnect(), $nom_objet);
    $id_categorie = $_POST['categorie'];
    $id_membre = $_POST['id_membre'];
    
    $filenames = "default.jpg";
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image_objet'])) {
        $uploadDir = __DIR__ . '/../assets/image/objet/';
        $maxSize = 2 * 1024 * 1024; // 2 Mo
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        $file = $_FILES['image_objet'];
        $nbfiles = count($file['name']);
        $filenames = "";
        for($i = 0; $i < $nbfiles; $i++){

            if ($file['error'][$i] !== UPLOAD_ERR_OK) {
                die('Erreur lors de l’upload : ' . $file['error']);
            }
            // Vérifie la taille
            if ($file['size'][$i] > $maxSize) {
                die('Le fichier est trop volumineux.');
            }
            
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name'][$i]);
            finfo_close($finfo);
            if (!in_array($mime, $allowedMimeTypes)) {
                die('Type de fichier non autorisé : ' . $mime);
            }
            
            // renommer le fichier
            $originalName = pathinfo($file['name'][$i], PATHINFO_FILENAME);
            $extension = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
            $newName = $originalName . '_' . uniqid() . '.' . $extension;
            
            // Déplace le fichier
            if (move_uploaded_file($file['tmp_name'][$i], $uploadDir . $newName)) {
                echo "Fichier uploadé avec succès : ". $newName;
                $filenames .= $newName;
                if ($i < ($nbfiles - 1)) {
                    $filenames .= ";";
                }
            } else {
                echo "Échec du déplacement du fichier.";
            }
        }
    }

    add_new_object($nom_objet, $id_categorie, $id_membre, $filenames);
    
    header('Location: ../modele/modele1.php?page=ajout-objet&success=0');
?>