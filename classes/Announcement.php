<?php
require_once 'Database.php';

class Announcement
{
    private $title;
    private $description;
    private $announcementDate;
    private $image;
    private $file;
    private $db;

    public function __construct($title, $description, $announcementDate, $image = '', $file = null)
    // Why is the image.jpg already in there!
    // Removed image. I just wrote image1.jpg, but it doesn't physically exist in my folders.
    {
        $this->title = $title;
        $this->description = $description;
        $this->announcementDate = $announcementDate;
        $this->image = $image;
        $this->file = $file;
        $this->db = getDBConnection();

        if (!is_dir("uploads/images")) {
            mkdir("uploads/images", true);
        }
        if (!is_dir("uploads/documents")) {
            mkdir("uploads/documents", true);
        }
    }

    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO announcements (title, description, announcement_date, image, file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $this->title, $this->description, $this->announcementDate, $this->image, $this->file);

        if ($stmt->execute()) {
            echo "Announcement saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    public function uploadImage($imageFile)
    {
        $targetDir = "uploads/images/";
        $this->image = $targetDir . basename($imageFile["name"]);

        if (move_uploaded_file($imageFile["tmp_name"], $this->image)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
        }
    }

    public function uploadFile($documentFile)
    {
        $targetDir = "uploads/documents/";
        $this->file = $targetDir . basename($documentFile["name"]);

        if (move_uploaded_file($documentFile["tmp_name"], $this->file)) {
            echo "File uploaded successfully.";
        } else {
            echo "Failed to upload file.";
        }
    }
}
?>
