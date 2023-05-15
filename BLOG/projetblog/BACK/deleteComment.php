<?php
require('connexion.php');

    $post_Id = intval($_GET['postId']);
    $id = intval($_GET['id']);
    $sql = "DELETE FROM comment WHERE Id = $id";



    if(mysqli_query($conn, $sql)){
         header('location: http://localhost/ProjetBlog/FRONT/detail.php?id=' . $post_Id . '>');
    } else {
        echo "Une erreur s'est produite lors de la suppression du post : " . mysqli_error($conn);
    }