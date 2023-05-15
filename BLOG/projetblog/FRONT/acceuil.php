<?php
require('..\BACK\connexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mon Blog</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <header>
		<ul class="nav">
    <?php  
        if($_SESSION != null){
          echo  '<li><a href="admin.php">Administration</a> </li>';
          echo  '<li><a href="../BACK/logout.php">Déconnexion</a></li>';
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
  } else{
    echo '</ul>';
  }  ?>



  <main>
    
  <div class="post-list">
  <?php
  //Convertis l'heure dans un format plus jolie
  function format_date($date) {
    $date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
    $formatted_date = $date->format("H:i d F Y");
    return $formatted_date;
  }

  //  print_r($_SESSION);
  $sql = "SELECT post.CreationTimestamp, post.Title, post.image_name , SUBSTRING(post.contents, 1, 100) AS short_contents, author.firstname, author.lastname FROM post JOIN author ON post.author_id = author.id ORDER BY post.CreationTimestamp DESC";
  $result = $conn->query($sql);


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
        echo '</div>';
    }
} else {
    echo "Aucun article trouvé";
}?>

</div>
</main>
<footer>
  <div class="footer-content">
    <p>Blog - Mathis Dumage</p>
  </div>
</footer>


</body>
</html>


