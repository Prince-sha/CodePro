<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

   $conn = Database::getDB();

    if (empty($name) || empty($email) || empty($phone)) {
        echo "All fields are required.";
    } else {
  
        $clients = new Clients($conn);
        $result = $clients->create($name, $email, $phone);
        echo $result; 
    }
}
?>

<!DOCTYPE html>

<head>
    
    <title>Create Client</title>
</head>
<body>
    <h1>Create New Client</h1>
    <form action="Clients.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <button type="submit">Create Client</button>
    </form>
</body>
</html>
