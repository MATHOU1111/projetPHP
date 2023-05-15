<?php



if(isset($_FILES['image'])){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    
    // Vérifier le type de fichier
    $file_ext = explode('.',$_FILES['image']['name']);
    $file_ext = strtolower(end($file_ext));
    $extensions = array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
        echo "Extension de fichier non autorisée, veuillez choisir une image JPEG ou PNG.";
    }
    
    // Vérifier la taille de l'image (10 Mo maximum)
    if($file_size > 10485760) {
        echo "La taille de l'image est trop grande, veuillez choisir une image de moins de 10 Mo.";
    }
    
    // Déplacer l'image vers le dossier images
    $upload_dir = "images/";
    $upload_file = $upload_dir . basename($file_name);
    
    if (move_uploaded_file($file_tmp, $upload_file)) {
        echo "L'image ". basename($file_name). " a été téléchargée avec succès.";

    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}