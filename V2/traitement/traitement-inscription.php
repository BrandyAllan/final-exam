<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    include("../inc/fonction.php");
    $nom = $_POST['nom'];
    $nom = mysqli_real_escape_string(dbconnect(), $nom);
    $ddns = $_POST['ddns'];
    $email = $_POST['email'];
    $email = mysqli_real_escape_string(dbconnect(), $email);
    $genre = $_POST['sexe'];
    $ville = $_POST['ville'];

    $uploadDir = __DIR__ . '/../assets/image/profil/';
    $maxSize = 2 * 1024 * 1024; // 2 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $newName = "default.jpg";

    // Vérifie si un fichier est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profil'])) {
        $file = $_FILES['profil'];
    
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l’upload : ' . $file['error']);
        }
        // Vérifie la taille
        if ($file['size'] > $maxSize) {
            die('Le fichier est trop volumineux.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé : ' . $mime);
        }

        // renommer le fichier
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;

        // Déplace le fichier
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            echo "Fichier uploadé avec succès : ". $newName;
            $verify = true;
        } else {
            echo "Échec du déplacement du fichier.";
        }
    }
    
    if(verify_inscription($email) > 0){
        header('Location: ../pages/inscription.php?error=0');
        exit;
    }
    if(verify_password($_POST['mdp'] ,$_POST['mdpbis']) == true){
        $mdp = $_POST['mdp'];
    }
    else{
        header('Location: ../pages/inscription.php?errormdp=0');
        exit;
    }
    $_SESSION['email'] = $email;
    $_SESSION['mdp'] = $mdp;
    add_new_member($nom, $ddns, $genre, $email, $ville, $mdp, $newName);
    header('Location: ../modele/modele1.php?page=home');
?>