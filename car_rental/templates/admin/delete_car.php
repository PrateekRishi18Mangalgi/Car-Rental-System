<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';  // Include database connection file

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Delete car from database
    $query = "DELETE FROM cars WHERE car_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $car_id);
    $stmt->execute();

    echo "Car deleted successfully!";
    header('Location: manage_cars.php');
}
?>
