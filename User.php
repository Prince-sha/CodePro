<?php
class User {

    public static function getDB() {
        $conn = new mysqli('localhost', 'root', '', 'codepro');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }

    public static function create($username, $email, $password) {
        $conn = self::getDB();
        
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
