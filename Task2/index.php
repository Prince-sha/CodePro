<?php
require_once 'announcement.php';
// require_once '../classes/Database.php' // I was expecting this class here as well
// We are trying to create one single app from all tasks that you will receive
// let's try to keep consistence in the code. 
// For now this is ok. But we will have one database for this entire app and 
// we may have multiple tables in it. 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // I am unable to see here any connection to database being formed
    // We never call database class into anyother class or make it extended if you have done so
    // somewhere!!!

    // $conn = Database::getDB() I was expecting this line here

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

<!-- When the annoncement is created where will be shown???? -->
 <!-- Make use of Ajax to show it here on the same page, you may consider it as you next task 3 -->

<!DOCTYPE html>
<head>
    
    <title>Create Announcement</title>
</head>
<body>
    <h2>Create Announcement</h2>
    <!-- This will be used for insering the data into database -->
     <!-- This code does not make use of bootstrap or CSS which is why it looks so bad -->
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
