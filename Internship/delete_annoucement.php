<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
if ($stmt->execute([$id])) {
    header('Location: dashboard.php');
    exit;
} else {
    echo "Failed to delete announcement.";
}
?>
