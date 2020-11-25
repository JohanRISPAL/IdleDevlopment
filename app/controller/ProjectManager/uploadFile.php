<?php
// Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["cv"]) && $_FILES["cv"]["error"] == 0){
        $allowed = array("pdf" => "application/pdf");
        $filename = $_FILES["cv"]["name"];
        $filetype = $_FILES["cv"]["type"];
        $filesize = $_FILES["cv"]["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists("E:/xampp/htdocs/IdleDevlopment/cv/" . $_FILES["cv"]["name"])){
                header('Location: http://localhost/idleDevlopment/index.php?p=candidate&role=projectManager&upload=fail');
            } else{
                move_uploaded_file($_FILES["cv"]["tmp_name"], "E:/xampp/htdocs/IdleDevlopment/cv/" . $_FILES["cv"]["name"]);
                header('Location: http://localhost/idleDevlopment/index.php?p=candidate&role=projectManager&upload=success');
            } 
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo "Error: " . $_FILES["cv"]["error"];
    }
}
?>