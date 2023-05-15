<?php
require('connexion.php');

if(isset($_GET['id'])){
    $post_id = intval($_GET['id']);
    $sql = "DELETE FROM post WHERE Id = $post_id";

    if(mysqli_query($conn, $sql)){
        header("location: http://localhost/projetblog/FRONT/admin.php");
    } else {
        echo "Une erreur s'est produite lors de la suppression du post : " . mysqli_error($conn);
    }
}
