<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: client_list.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->execute([$id]);
$client = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE clients SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    if ($stmt->execute([$name, $email, $phone, $address, $id])) {
        header('Location: client_list.php');
        exit;
    } else {
        echo "Failed to update client.";
    }
}
?>
<form method="POST" style="max-width: 400px; margin: auto; padding: 1em; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($client['name']); ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
    <label>Address:</label>
    <textarea name="address" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><?php echo htmlspecialchars($client['address']); ?></textarea><br>
    <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Update Client</button>
</form>

<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: client_list.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
$stmt->execute([$id]);

header('Location: client_list.php');
exit;