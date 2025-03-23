<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';  // Default user for XAMPP
$password = '';  // Default password for XAMPP
$dbname = 'car_rental';

// Create a new connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Display the error if the connection fails
}
?>
