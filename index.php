<?php
require 'Clients.php'; 
require 'dbconfig.php'; 


$conn = getDBConnection(); 


$response = Clients::create($conn, 'Prince', 'princesh@gmail.com', '03422166654');

if (strpos($response, 'Error') !== false) {
    echo "Failed to create client: " . $response;
} else {
    echo "Client created successfully.";
}
?>
