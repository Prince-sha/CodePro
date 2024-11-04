<?php
require_once 'announcement.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $announcementDate = $_POST['announcementDate'];

    $announcement = new Announcement($title, $description, $announcementDate);
  
    if (!empty($_FILES['image']['name'])) {
        $announcement->uploadImage($_FILES['images']);
    }

    if (!empty($_FILES['file']['name'])) {
        $announcement->uploadFile($_FILES['documents']);
    }

    $announcement->save();
}
?>
<!DOCTYPE html>
<head>
    
    <title>Create Announcement</title>
</head>
<body>
    <h2>Create Announcement</h2>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="description" placeholder="Description" required></textarea><br><br>
        <input type="date" name="announcementDate" required><br><br>
        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*"><br><br>
        <label for="file">Upload Document:</label>
        <input type="file" name="file" accept=".pdf,.doc,.docx,.txt"><br><br>
        <button type="submit">Submit Announcement</button>
    </form>
</body>
</html>
