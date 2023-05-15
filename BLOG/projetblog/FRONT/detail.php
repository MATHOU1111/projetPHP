<?php
	require('..\BACK\connexion.php');


  	//Convertis l'heure dans un format plus jolie
  	function format_date($date) {
		$date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
		$formatted_date = $date->format("H:i d-F-Y");
		return $formatted_date;
  	}

	if(isset($_GET['id'])) {
				$id = intval($_GET['id']);
			}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
	<title>Détails de l'article <?php echo $id ?></title>
	<link rel="stylesheet" href='CSS\style.css'>
	<link rel="stylesheet" href='CSS\details.css'>
</head>
<body>
	<header>
		<h2>Détails de l'article :  <?php echo $id; ?> </h2>
		<ul class="nav"> 
		<?php  
		echo '<li><a href="http://localhost/projetblog/FRONT/acceuil.php">Accueil</a></li>';
		if($_SESSION != null){
			echo '<li><a href="../BACK/logout.php">Déconnexion</a></li>';
        }
		else{
          echo '<li> <a href="login.php">Se connecter</a>';
        }
    ?>
	</header>
	<div class="detail">
		<article>
			<?php
			//Affichage du post selon son Id
			$post_content = "SELECT * FROM post WHERE id = $id";
			$result = $conn->query($post_content);
			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
					echo '<div class="title"><p>' . $row['Title'] . '</p></div><br>';
					$formatted_date = format_date($row['CreationTimestamp']);
					echo '<div class="content"><p>' . $row['Contents'] . '</p></div>';
					if($row['image_name'] != null){
						echo '<br><div class="image"> <img src="images/' . $row['image_name']  . '" alt="Image du post" width="300" height="212"></div>';
					  }
					echo '<div class="date1"><p>' . $formatted_date;
					if($row['Modifié'] == 1 ){
						echo ' - modifié </h3></div>';
					}
					else{
						echo '</h3></div>';
					}
				}
			} else {
				echo "Aucun résultat trouvé";
			}
			?>
		</article>
		<?php

		//Affichage des commentaires du post
			$sqlCommentaire = "SELECT * FROM comment WHERE Post_Id = $id";
			$resultCommentaire = $conn->query($sqlCommentaire);
			if(mysqli_num_rows($resultCommentaire) > 0) {
				while($rowC = mysqli_fetch_array($resultCommentaire)) {
					echo '<div class="comment" id='. $rowC["Id"].'><div class="pseudo"><p>' . $rowC['NickName']. '</p></div>';
					echo '<div class="message"><p>' . $rowC['Contents']. '</p></div>';
					//Formattage de la date
					$formatted_date = format_date($rowC['CreationTimestamp']);
					echo '<div class="date1"><p>' . $formatted_date. '</p>';
					echo '</div>';
					if($_SESSION['user_id'] !== null){
						echo '<a href="../BACK/deleteComment.php?id='. $rowC["Id"] .'&postId='. $id. '">';
						echo '<button class="button-blue">Supprimer le commentaire</button>';
						echo '</a>';
					}
					echo '</div>';					
				}
			}
		?>
		<!-- Affichage des inputs pour poster un commentaire -->
		<div class="commentPosting">
			<form method="POST" action='../BACK/newComment.php?id=<?php echo $id ?>'>
				<input type="text" name="pseudo" id="pseudo" placeholder="NOM D'UTILISATEUR" required>
				<br>
				<textarea name="contenu" id="contenu" rows="10" placeholder="VOTRE MESSAGE..." required></textarea>
				<br>
				<button type="submit">Poster le commentaire</button>
			</form>
		</div>
	</div>
</body>
</html>


