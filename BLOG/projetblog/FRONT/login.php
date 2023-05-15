<?php
require('..\BACK\connexion.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="CSS\style.css">
</head>
<body>
<header>
		<ul class="nav">
    <?php  
      echo '<li><a href="http://localhost/projetblog/FRONT/acceuil.php">Accueil</a></li>'
    ?> 
	</header>


<form method="post">
<div class="signin-container">
    <h1>Login</h1>
    <form>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      <br>
      <button type="submit">Se connecter</button>
    </form>
    <?php if(isset($error)) { ?>
      <div><?php echo $error; ?></div>
    <?php } ?>
  </div>
  
</form>


</body>
</html>








