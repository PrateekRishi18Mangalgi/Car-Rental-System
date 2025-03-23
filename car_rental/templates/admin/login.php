<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include '../../includes/db.php';  // Include database connection file
include '../../includes/header.php';  // Include header

echo "Form submitted.<br>";  // Debugging

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging to show form values
    echo "Received Username: " . htmlspecialchars($username) . "<br>";
    echo "Received Password: " . htmlspecialchars($password) . "<br>";

    // Query the database for the admin user
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    if (!$stmt) {
        echo "Error in preparing the SQL statement: " . $conn->error . "<br>";
    } else {
        echo "SQL statement prepared successfully.<br>";
    }

    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    // Check if the query executed properly
    if ($stmt->error) {
        echo "Error executing the query: " . $stmt->error . "<br>";
    } else {
        echo "Query executed successfully.<br>";
    }

    $result = $stmt->get_result();

    // Debugging result count
    echo "Number of rows found: " . $result->num_rows . "<br>";

    // Check if a valid admin user is found
    if ($result->num_rows === 1) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<div class="container">
    <h2>Admin Login</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
