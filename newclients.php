<?php
require 'Clients.php'; 
require 'Database.php'; 
require 'vendor/autoload.php'; 

use Endroid\QrCode\Builder\Builder; 

$clients = new Clients($conn);


$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (empty($name) || empty($email) || empty($phone)) {
        $message = "All fields are required.";
    } else {

        $message = $clients->create($name, $email, $phone);
    }
}

$allClients = $clients->readAll();

function generateQrCode($client)
{
    $data = "ID: {$client['id']}\nName: {$client['name']}\nEmail: {$client['email']}\nPhone: {$client['phone']}";
    $result = Builder::create()
        ->data($data)
        ->size(200)
        ->margin(10)
        ->build();


    $fileName = "qrcodes/qr_{$client['id']}.png";
    $result->saveToFile($fileName);

    return $fileName;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients Management</title>
</head>
<body>
    <h1>Create New Client</h1>

    <?php if (!empty($message)) { ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php } ?>

    <form action="index.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <button type="submit">Create Client</button>
    </form>

    <h1>Clients List</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allClients as $client) { 
                $qrCodePath = generateQrCode($client);
            ?>
                <tr>
                    <td><?= htmlspecialchars($client['id']) ?></td>
                    <td><?= htmlspecialchars($client['name']) ?></td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['phone']) ?></td>
                    <td><img src="<?= htmlspecialchars($qrCodePath) ?>" alt="QR Code"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
