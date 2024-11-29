<?php
include 'classes/Database.php';
include 'classes/User.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Database connection is established here
   
    $conn = Database::getDB();

    User::create( $conn, $username, $email, $password);
}
?>
