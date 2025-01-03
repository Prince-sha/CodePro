<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM clients");
$clients = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f9f0;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            color: #2d7d2d;
        }
        a {
            text-decoration: none;
            color: #2d7d2d;
        }
        a:hover {
            color: #1c5b1c;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #2d7d2d;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2d7d2d;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #e9f7e9;
        }
        tr:hover {
            background-color: #d0efd0;
        }
        .actions a {
            margin: 0 5px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .qr-code img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Clients</h1>
    <a href="create_client.php">Add New Client</a><br><br>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>QR Code</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($clients as $client): 
            $qrData = "Name: " . $client['name'] . "\n" .
                      "Email: " . $client['email'] . "\n" .
                      "Phone: " . $client['phone'] . "\n" .
                      "Address: " . $client['address'];
            $qrCodeURL = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" . urlencode($qrData) . "&choe=UTF-8";
        ?>
        <tr>
            <td><?php echo htmlspecialchars($client['name']); ?></td>
            <td><?php echo htmlspecialchars($client['email']); ?></td>
            <td><?php echo htmlspecialchars($client['phone']); ?></td>
            <td><?php echo htmlspecialchars($client['address']); ?></td>
            <td class="qr-code">
                <img src="<?php echo $qrCodeURL; ?>" alt="QR Code">
            </td>
            <td class="actions">
                <a href="edit_client.php?id=<?php echo $client['id']; ?>">Edit</a> |
                <a href="delete_client.php?id=<?php echo $client['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
