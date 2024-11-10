<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'codepro');
define('DB_PASSWORD', 'princehash1');
define('DB_NAME', 'announcement_db');
// this is okay but we already had Database.php in classes folder.

function getDBConnection() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
