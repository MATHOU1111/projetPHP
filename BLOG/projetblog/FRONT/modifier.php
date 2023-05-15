<?php
require('..\BACK\connexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS\style.css">
</head>
<header>
<ul class="nav">
    <?php  
        if($_SESSION != null){
          echo '<li><a href="http://localhost/projetblog/FRONT/acceuil.php">Accueil</a></li>
          <li><a href="../BACK/logout.php">Déconnexion</a></li>';
        }else{
          echo '<li> <a href="login.php">Se connecter</a>';
        }
    ?> 
</header>
<body>
<?php
    if(isset($_GET['id'])){
        $post_id = intval($_GET['id']);
    }?>
<?php
// Récupération du post à modifier
$sql = "SELECT * FROM post WHERE Id = $post_id";
$result = $conn->query($sql);

// Vérification que le post existe
if ($result->num_rows > 0) {
    // Récupération de toutes les données du post
    $row = $result->fetch_assoc();

    // Récupération de l'auteur du post
    $sqlId = "SELECT * FROM author WHERE Id = '{$row['Author_Id']}'";
    $resultId = $conn->query($sqlId);

    // Vérification que l'auteur existe
    if ($resultId->num_rows > 0) {
        $rowId = $resultId->fetch_assoc();

        // Affichage du formulaire pour modifier le post
        echo '<div class="modifierPost">';
        echo '<form method="POST" action="../BACK/modifierPost.php?id=' . $post_id . '" enctype="multipart/form-data">';
        echo '<h4>Auteur : ' . $rowId['FirstName'] . ' ' . $rowId['LastName'] . '</h4>';
        echo '<label for="titre">Titre :</label>';
        echo '<input type="text" name="titre" id="titre" value="' . $row['Title'] . '" required>';
        echo '<br>';
        echo '<label for="contenu">Contenu :</label>';
        echo '<textarea name="contenu" id="contenu" rows="12" required>' . $row['Contents'] . '</textarea>';
        echo '<br>';
        ?>
        <label for="image">Envoi d'image : </label>
        <input type="file" name="image" id="image">
        <label for="contenu">Category</label>
        <select name="category" id="category">
        <?php
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo '<option value='. $row['Id']. '>'.$row['Name'].'</option>';
                };
            }
        ?>
        
        </select>
        <br>
        <?php
        echo '<button type="submit">Modifier le post</button>';
        echo '</form>';
        echo '</div>';

    } else {
        echo "L'auteur du post n'existe pas.";
    }
} else {
    echo "Le post n'existe pas.";
}
?>
</body>
</html>
