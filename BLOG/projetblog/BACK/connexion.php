<?php
session_start();
// informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn = mysqli_connect ($servername, $username, $password, $dbname);

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM author WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['Id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['FirstName'];
        $_SESSION['lastname'] = $row['LastName'];
        header("Location: http://localhost/projetblog/FRONT/admin.php");
    } else {
        $error = "<div class='errorMessage'>Identifiants ou mot de passe invalide</div>";
    }

}
?>
