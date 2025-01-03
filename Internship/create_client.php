<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $phone, $address])) {
        header('Location: client_list.php');
        exit;
    } else {
        echo "Failed to create client.";
    }
}
?>
<form method="POST" style="max-width: 400px; margin: auto; padding: 1em; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <label>Name:</label>
    <input type="text" name="name" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Email:</label>
    <input type="email" name="email" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Phone:</label>
    <input type="text" name="phone" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Address:</label>
    <textarea name="address" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea><br>
    <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Create Client</button>
</form>
