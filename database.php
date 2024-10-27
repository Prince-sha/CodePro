<?php
class Database {

    public static function getDB() {
        $conn = new mysqli('localhost', 'root', '', 'codepro');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }
}
?>
