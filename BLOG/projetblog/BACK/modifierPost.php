<?php
require('connexion.php');

// Récupération des données du formulaire
$id = intval($_GET['id']);
$title = $_POST["titre"];
$contenu = $_POST["contenu"];
$category = $_POST["category"];
$modifié = 1;
$image_name = '';

// Vérification si une image a été téléchargée
if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
    $image_name = basename($_FILES["image"]["name"]);

    // Déplacement de l'image téléchargée vers le dossier images dans le dossier racine
    if(move_uploaded_file($_FILES["image"]["tmp_name"], "../FRONT/images/".$image_name)){
        // Création de la requête SQL pour modifier le post avec l'image
        $stmt = $conn->prepare("UPDATE post SET Modifié = ?, Title = ?, Contents = ?, Category_Id = ?, image_name = ? WHERE Id = ?");
        $stmt->bind_param("issssi", $modifié, $title, $contenu, $category, $image_name, $id);
        $stmt->execute();
        
        // Exécution de la requête SQL
        if ($stmt) {
            header("location: http://localhost/projetblog/FRONT/admin.php");
        } else {
            echo "Une erreur s'est produite lors de la modification du post : " . mysqli_error($conn);
        }
    } else {
        echo "Une erreur s'est produite lors du téléchargement de l'image : " . $_FILES["image"]["error"];
    }
} else {
    // Création de la requête SQL préparée pour modifier le post sans l'image
    $stmt = mysqli_prepare($conn, "UPDATE post SET Modifié = ?, Title = ?, Contents = ?, Category_Id = ? WHERE Id = ?");
    mysqli_stmt_bind_param($stmt, "isssi", $modifié, $title, $contenu, $category, $id);

    // Exécution de la requête SQL préparée
    if (mysqli_stmt_execute($stmt)) {
        header("location: http://localhost/projetblog/FRONT/admin.php");
    } else {
        echo "Une erreur s'est produite lors de la modification du post : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
