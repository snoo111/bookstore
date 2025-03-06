<?php
/* Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize payment_successful as false
$payment_successful = false;

// Get the transaction ID from the URL (passed as 'oid' parameter)
if (isset($_GET['oid'])) {
    $transactionId = $_GET['oid']; // Get the transaction ID from the URL
    // Fetch the order details based on the transaction ID
    $stmt = $conn->prepare("SELECT * FROM payments WHERE transaction_id = ?");
    $stmt->bind_param("s", $transactionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $payment = $result->fetch_assoc();
        echo "<h2>Payment Successful!</h2>";
        echo "<p>Transaction ID: " . $payment['transaction_id'] . "</p>";
        echo "<p>Amount: " . $payment['amount'] . "</p>";
        echo "<p>Phone Number: " . $payment['phone_number'] . "</p>";
        echo "<p>Username: " . $payment['username'] . "</p>";
        
        // Set $payment_successful to true since the payment details exist
        $payment_successful = true;
    } else {
        echo "No payment found for this transaction ID.";
    }
    $stmt->close();
} else {
    echo "Transaction ID is missing in the URL.";
}

// Assuming payment is successful and order is placed
if ($payment_successful) {

    // 1. Insert order details into the orders table
    // (Add your code for order insertion here)

    // 2. Empty the cart for the current user after order completion
    $user_id = $_SESSION['user_id']; // Or retrieve from a session/cookie

    $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    // 3. Redirect the user to the homepage after successful order and emptying cart
    header("Location: homepage.php");
    exit; // Always exit after header redirect
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <h2>Payment Successful!</h2>
    <p>Your payment was successfully processed. Thank you for your order!</p>
    <p><a href="home.php">Go back to homepage</a></p>
</body>
</html>
*/