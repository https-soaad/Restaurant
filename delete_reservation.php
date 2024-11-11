<?php
session_start();
require_once 'db_connection.php';

// Check admin authentication
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Check if ID is provided and is numeric
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error_message'] = "Invalid reservation ID";
    header('Location: admin_dashboard.php');
    exit();
}

$id = (int)$_POST['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Reservation successfully deleted";
    } else {
        $_SESSION['error_message'] = "Reservation not found";
    }
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error deleting reservation: " . $e->getMessage();
}

header('Location: admin_dashboard.php');
exit();
