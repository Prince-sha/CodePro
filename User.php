<?php
include 'database.php';

class User {
    public static function create($username, $email, $password) {
           $conn = Database::getDB();

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: ". $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>
