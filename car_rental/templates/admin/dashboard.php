<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../../includes/db.php';  // Include database connection file
include '../../includes/header.php';  // Include header

// Fetch all bookings
$query = "SELECT * FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($query);

?>

<div class="container">
    <h2>Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
    <h3>Bookings</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Car Name</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['booking_id'] ?></td>
                    <td><?= $row['user_name'] ?></td>
                    <td><?= $row['car_name'] ?></td>
                    <td><?= $row['booking_date'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <?php if ($row['status'] === 'Pending'): ?>
                            <a href="approve.php?id=<?= $row['booking_id'] ?>">Approve</a> | 
                            <a href="reject.php?id=<?= $row['booking_id'] ?>">Reject</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
