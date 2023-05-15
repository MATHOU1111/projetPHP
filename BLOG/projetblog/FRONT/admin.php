<?php
require('..\BACK\connexion.php');
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog Admin</title>
  <link rel="stylesheet" href="CSS/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
  <?php if($_SESSION != null){
    echo '<ul class="user-info">';
    echo '<li>Connecté en tant que: ';
    echo  $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</li>';
    echo '</ul>';
  } 
  ?>

  <main>

<?php
  //Convertis l'heure dans un format plus jolie
  function format_date($date) {
    $date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
    $formatted_date = $date->format("H:i d F Y");
    return $formatted_date;
  }

  echo '<div class="addPost"><a href="ajoutPost.php"><button class="button-blue">Ajouter un post</button></a></div><br>';
  $sql = "SELECT post.CreationTimestamp, post.Title, SUBSTRING(post.contents, 1, 100) AS short_contents, author.firstname, author.lastname FROM post JOIN author ON post.author_id = author.id ORDER BY post.CreationTimestamp DESC";
  $result = $conn->query($sql);
?>
<div class="post-list">
<?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sqlIdDelete = 'SELECT Id FROM post WHERE Title ="'. $row['Title'] . '"';
        $resultId = $conn->query($sqlIdDelete);
        $idPost = $resultId->fetch_assoc()['Id'];
        echo '<div class="post" id="' . $idPost . '">';
        echo '<a href="/ProjetBlog/FRONT/detail.php?id=' . $idPost . '">';
        echo '<div class="author"><p>' . $row["firstname"] . " " . $row["lastname"] . '</p></div>';
        echo '<div class="title"><p>' . $row["Title"] . '</p></div>';
        echo '<div class="content"><p>' . $row["short_contents"] . '...</p></div>';
        $formatted_date = format_date($row['CreationTimestamp']);
        echo '<div class="date"><p>' . $formatted_date . '</p></div>';
        echo '</a>';
        echo '<a href="/ProjetBlog/FRONT/modifier.php?id=' . $idPost . '"><button class="button-blue">Modifier</button></a>';
        echo '<a href="/ProjetBlog/BACK/delete.php?id=' . $idPost . '"><button class="button-red">Supprimer</button></a>';
        echo '</div>';
  }
} else {
  echo "<br> Aucun article trouvé";
}

?>
</div>
  </main>
  <footer>
  <div class="footer-content">
    <p>Blog - Mathis Dumage</p>
  </div>
</footer>
</body>
</html>
