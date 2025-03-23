<?php
include '../../includes/db.php';  // Include database connection file
include '../../includes/header.php';  // Include header

// Fetch all cars from the database
$query = "SELECT * FROM cars";
$cars_result = $conn->query($query);

if ($cars_result->num_rows > 0):  // Check if there are any cars in the database
    while ($car = $cars_result->fetch_assoc()): 
?>
    <div class="col-md-4">
        <div class="card">
            <img src="../../assets/images/<?= isset($car['image']) ? $car['image'] : 'default.jpg' ?>" class="card-img-top" alt="<?= isset($car['car_name']) ? $car['car_name'] : 'Car Image' ?>">
            <div class="card-body">
                <h5 class="card-title"><?= isset($car['car_name']) ? $car['car_name'] : 'Unknown Car' ?></h5>
                <p class="card-text"><?= isset($car['car_description']) ? $car['car_description'] : 'No description available.' ?></p>
                <p>Price per day: $<?= isset($car['price_per_day']) ? $car['price_per_day'] : '0.00' ?></p>
                <a href="booking.php?car_id=<?= $car['car_id'] ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>
<?php 
    endwhile;
else:
    echo "No cars available.";
endif;

include '../../includes/footer.php'; 
?>
