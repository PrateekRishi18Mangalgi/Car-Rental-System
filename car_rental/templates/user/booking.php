<?php
// Inside the POST request handling in user/booking.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input for booking
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $rental_start = $_POST['rental_start'];
    $rental_end = $_POST['rental_end'];

    // Insert booking details into database
    $query = "INSERT INTO bookings (car_id, user_name, user_email, rental_start, rental_end) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issss', $car_id, $user_name, $user_email, $rental_start, $rental_end);
    $stmt->execute();

    // Send booking confirmation email
    $subject = "Car Rental Booking Confirmation";
    $message = "Dear $user_name,\n\nYour booking for the car $car[car_name] has been confirmed. Your rental period is from $rental_start to $rental_end.\n\nThank you for choosing our service!";
    $headers = "From: no-reply@carrentalsystem.com";

    if (mail($user_email, $subject, $message, $headers)) {
        echo "Booking confirmed! A confirmation email has been sent to you.";
    } else {
        echo "Booking confirmed, but email notification failed.";
    }
}
?>
