<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';  // Include database connection file

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    // Fetch car details for editing
    $query = "SELECT * FROM cars WHERE car_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $car_name = $_POST['car_name'];
        $car_description = $_POST['car_description'];
        $price_per_day = $_POST['price_per_day'];

        // Update car details
        $query = "UPDATE cars SET car_name = ?, car_description = ?, price_per_day = ? WHERE car_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdi', $car_name, $car_description, $price_per_day, $car_id);
        $stmt->execute();

        echo "Car details updated!";
    }
}
?>

<div class="container">
    <h2>Edit Car</h2>
    <form method="POST">
        <label for="car_name">Car Name:</label>
        <input type="text" name="car_name" id="car_name" value="<?= $car['car_name'] ?>" required>

        <label for="car_description">Car Description:</label>
        <textarea name="car_description" id="car_description" required><?= $car['car_description'] ?></textarea>

        <label for="price_per_day">Price per day:</label>
        <input type="number" name="price_per_day" id="price_per_day" value="<?= $car['price_per_day'] ?>" required>

        <button type="submit">Update Car</button>
    </form>
</div>
