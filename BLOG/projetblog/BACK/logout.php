<?php 

session_destroy();

print_r($_SESSION);
if($_SESSION === null){
    header("location: http://localhost/projetblog/FRONT/login.php");
}

?>