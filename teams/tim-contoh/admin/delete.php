<?php
require_once '../config.php';

// Check if logged in
if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? 0;

try {
    // Delete destination
    $stmt = $conn->prepare("DELETE FROM destinations WHERE id = ?");
    $stmt->execute([$id]);
    
    // Redirect with success message
    header('Location: dashboard.php?deleted=1');
    exit;
} catch(PDOException $e) {
    die('Error deleting destination: ' . $e->getMessage());
}
?>
