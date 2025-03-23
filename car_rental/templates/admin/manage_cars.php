<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';  // Include database connection file
include '../../includes/header.php';  // Include header

// Add car to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_car'])) {
    $car_name = $_POST['car_name'];
    $car_description = $_POST['car_description'];
    $price_per_day = $_POST['price_per_day'];
    $car_image = $_FILES['car_image']['name'];

    // Upload image
    $target_dir = "../../assets/images/";
    $target_file = $target_dir . basename($_FILES["car_image"]["name"]);
    move_uploaded_file($_FILES["car_image"]["tmp_name"], $target_file);

    // Insert car details into the database
    $query = "INSERT INTO cars (car_name, car_description, price_per_day, car_image, availability) 
              VALUES (?, ?, ?, ?, 1)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssds', $car_name, $car_description, $price_per_day, $car_image);
    $stmt->execute();

    echo "Car added successfully!";
}

// Fetch all cars to display
$query = "SELECT * FROM cars";
$cars_result = $conn->query($query);
?>

<div class="container">
    <h2>Manage Cars</h2>

    <!-- Add Car Form -->
    <form method="POST" enctype="multipart/form-data">
        <label for="car_name">Car Name:</label>
        <input type="text" name="car_name" id="car_name" required>

        <label for="car_description">Car Description:</label>
        <textarea name="car_description" id="car_description" required></textarea>

        <label for="price_per_day">Price per day:</label>
        <input type="number" name="price_per_day" id="price_per_day" required>

        <label for="car_image">Car Image:</label>
        <input type="file" name="car_image" id="car_image" required>

        <button type="submit" name="add_car">Add Car</button>
    </form>

    <h3>Car Listings</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Car ID</th>
                <th>Car Name</th>
                <th>Price per Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $cars_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['car_id'] ?></td>
                    <td><?= $row['car_name'] ?></td>
                    <td>$<?= $row['price_per_day'] ?></td>
                    <td>
                        <a href="edit_car.php?id=<?= $row['car_id'] ?>">Edit</a> | 
                        <a href="delete_car.php?id=<?= $row['car_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
