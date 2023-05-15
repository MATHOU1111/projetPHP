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
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
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
    <div class="modifierPost">
        <form method="POST" action="http://localhost/projetblog/BACK/newPost.php" enctype="multipart/form-data">
            <h4>Auteur : <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];?></h4>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" required>
            <br>
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" rows="10" required></textarea>
            <br>
            <label for="image">Envoi d'image : </label>
            <input type="file" name="image" id="image">
            <br>
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
            <button type="submit">Créer le post</button>
        </form>
    </div>
    <footer>
    <div class="footer-content">
        <p>Blog - Mathis Dumage</p>
    </div>
    </footer>
</body>
</html>
