<?php
include 'classes/dbconfig.php';

class User {
    public static function create($conn, $username, $email, $password) {
    
       

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
