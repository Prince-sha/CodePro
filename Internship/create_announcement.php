<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $pdo->prepare("INSERT INTO announcements (title, description, image, user_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$title, $description, $image, $user_id])) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Failed to create announcement.";
    }
}
?>
<form method="POST" enctype="multipart/form-data" style="max-width: 400px; margin: auto; padding: 1em; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <label style="display: block; margin-bottom: 8px;">Title:</label>
    <input type="text" name="title" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label style="display: block; margin-bottom: 8px;">Description:</label>
    <textarea name="description" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea><br>
    <label style="display: block; margin-bottom: 8px;">Image:</label>
    <input type="file" name="image" style="margin-bottom: 10px;"><br>
    <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Create</button>
</form>
