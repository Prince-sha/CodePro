<?php
require 'Clients.php'; 
require 'Databse.php'; 

Clients::create($conn, 'Prince', 'princesh@gmail.com', '03422166654');

echo "Client created successfully.";
?>

