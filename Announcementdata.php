<?php
require_once '../classes/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $conn = Database::getDB();

    $title = $_POST['title'];
    $description = $_POST['description'];
    $announcementDate = $_POST['announcementDate'];

    $announcement = new Announcement($title, $description, $announcementDate);

    $response = ['success' => false, 'message' => '', 'data' => []];

    
    if (!empty($_FILES['image']['name'])) {
        $imageUploadStatus = $announcement->uploadImage($_FILES['image']);
        if (!$imageUploadStatus) {
            $response['message'] = "Error uploading image.";
            echo json_encode($response);
            exit;
        }
    }

    if (!empty($_FILES['file']['name'])) {
        $fileUploadStatus = $announcement->uploadFile($_FILES['file']);
        if (!$fileUploadStatus) {
            $response['message'] = "Error uploading file.";
            echo json_encode($response);
            exit;
        }
    }

    if ($announcement->save($conn)) {
        $response['success'] = true;
        $response['message'] = "Announcement created successfully.";
        $response['data'] = [
            'title' => $title,
            'description' => $description,
            'announcementDate' => $announcementDate
        ];
    } else {
        $response['message'] = "Error saving announcement.";
    }

    echo json_encode($response);
    exit;
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Create Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
        }
        input, textarea, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 14px;
        }
        #announcements {
            margin-top: 20px;
        }
        .announcement {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Create Announcement</h2>
    <form id="announcementForm" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="date" name="announcementDate" required>
        
        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*">
        
        <label for="file">Upload Document:</label>
        <input type="file" name="file" accept=".pdf,.doc,.docx,.txt">
        
        <button type="submit">Submit Announcement</button>
    </form>

    <div id="announcements">
     
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('announcementForm');
            const announcementsContainer = document.getElementById('announcements');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                
            
                const formData = new FormData(form);

                try {
                    const response = await fetch('index.php', {
                        method: 'POST',
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();

                    if (result.success) {
                        const announcementHtml = `
                            <div class="announcement">
                                <h3>${result.data.title}</h3>
                                <p>${result.data.description}</p>
                                <small>${result.data.announcementDate}</small>
                            </div>
                        `;
                        announcementsContainer.insertAdjacentHTML('afterbegin', announcementHtml);
                        alert(result.message);
                        form.reset(); 
                    } else {
                        alert(result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    </script>
</body>
</html>


