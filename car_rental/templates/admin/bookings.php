<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';  // Include database connection file
include '../../includes/header.php';  // Include header

// Fetch all bookings from the database
$query = "SELECT bookings.booking_id, cars.car_name, bookings.user_name, bookings.user_email, bookings.rental_start, bookings.rental_end
          FROM bookings 
          JOIN cars ON bookings.car_id = cars.car_id";
$bookings_result = $conn->query($query);
?>

<div class="container">
    <h2>All Bookings</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Car Name</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Rental Start</th>
                <th>Rental End</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $booking['booking_id'] ?></td>
                    <td><?= $booking['car_name'] ?></td>
                    <td><?= $booking['user_name'] ?></td>
                    <td><?= $booking['user_email'] ?></td>
                    <td><?= $booking['rental_start'] ?></td>
                    <td><?= $booking['rental_end'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
