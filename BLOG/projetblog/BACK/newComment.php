<?php
require('connexion.php');

//On récupère la date actuelle et on l'a mets au format français
date_default_timezone_set('Europe/Paris');
$heure = date("H:i:s");
$date =  date("Y-m-d");
$datetime = date("Y-m-d H:i:s", strtotime("$date $heure"));

// Récupération des données du formulaire
$pseudo = $_POST["pseudo"];
$contents = $_POST['contenu'];
$id = intval($_GET['id']);

// Préparation de la requête SQL
$stmt = mysqli_prepare($conn, "INSERT INTO comment (NickName, Contents, CreationTimestamp, Post_Id) VALUES (?, ?, ?, ?)");

// Liaison des paramètres
mysqli_stmt_bind_param($stmt, "sssi", $pseudo, $contents, $datetime, $id);

// Exécution de la requête préparée
if (mysqli_stmt_execute($stmt)) {
    header('location: http://localhost/ProjetBlog/FRONT/detail.php?id=' . $id . '>');
} else {
    echo "Une erreur s'est produite lors de la création du post : " . mysqli_error($conn);
    echo '<br>'. $pseudo  . ' - '. ' - ' .  $Contents .' - ' . ' - '. $datetime . ' -  '. ' - ' . $id;
}

// Fermeture du statement et de la connexion
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>