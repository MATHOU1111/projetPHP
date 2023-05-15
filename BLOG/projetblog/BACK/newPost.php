<?php
require('connexion.php');

$image_name ="";

if(isset($_FILES['image'])){
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
    $upload_dir = "../FRONT/images/";
    $file_name = $_FILES['image']['name'];
    $upload_file = $upload_dir . basename($file_name);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
        echo "L'image ". basename($file_name). " a été téléchargée avec succès.";

    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
} 
else {
    echo "Erreur lors du téléchargement de l'image.";
    $file_name = "";
}



//On récupère la date actuelle et on l'a mets au format français
date_default_timezone_set('Europe/Paris');
$heure = date("H:i:s");
$date =  date("Y-m-d");
$datetime = date("Y-m-d H:i:s", strtotime("$date $heure"));

// Récupération des données du formulaire
$Title = $_POST["titre"];
$contents = $_POST['contenu'];
$authorID = $_SESSION['user_id'];
$category = $_POST["category"];
$modifié = 0;
$image_name = basename($file_name);


$sql = "INSERT INTO post (Title, Contents, CreationTimestamp, Author_Id, Category_Id , Modifié, image_name) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo "Une erreur s'est produite lors de la préparation de la requête : " . mysqli_error($conn);
    exit;
}

// Liaison 
mysqli_stmt_bind_param($stmt, 'ssssiis', $Title, $contents, $datetime, $authorID, $category , $modifié, $image_name);

// Exécution requête
if (mysqli_stmt_execute($stmt)) {
    header("location: http://localhost/projetblog/FRONT/admin.php");

} else {
    echo "Une erreur s'est produite lors de la création du post : " . mysqli_error($conn);
    echo '<br>'. $Title  . ' '. ' ' .  $Contents .' ' . ' '. $datetime . ' '. ' ' . $authorID . ' '. ' ' .$category;
    echo "<br> L'image ". basename($file_name). " a été téléchargée avec succès.";
}

// Fermeture de la requête préparée et de la connexion
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>