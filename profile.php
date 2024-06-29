<?php
// Start session
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include config file
include 'config.php';

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `users` WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add your CSS stylesheets here -->
</head>
<body>
    <h1>User Profile</h1>
    <p>Welcome, <?php echo $user['name']; ?>!</p>
    <p>Your Email: <?php echo $user['email']; ?></p>
    <!-- Add more profile information as needed -->

    <a href="logout.php">Logout</a>
    <!-- Add more profile-related actions/links-->
</body>
</html>
