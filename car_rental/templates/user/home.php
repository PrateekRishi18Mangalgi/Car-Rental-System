<?php
include '../../includes/db.php';
include '../../includes/header.php';

$result = $conn->query("SELECT * FROM cars");
?>
<div class="container">
    <h2>Welcome to the Car Rental System</h2>
    <h3>Available Cars</h3>
    <div class="car-listing">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="car-item">
                <img src="../assets/images/<?= $row['image'] ?>" alt="<?= $row['name'] ?>" />
                <h4><?= $row['name'] ?> - <?= $row['brand'] ?></h4>
                <p>Price: $<?= $row['price'] ?> per day</p>
                <a href="booking.php?car_id=<?= $row['id'] ?>">Book this car</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>
