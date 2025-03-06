<?php
// Database connection
/*$host = "localhost";
$user = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($host, $user, $password, $dbname);
$transactionId = uniqid('txn_', true);  // Generates a unique ID like txn_1234567890abcdef

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch data from the form
    $amount = $_POST['amount'];
    $transactionId = $_POST['transactionId'];
    $phoneNumber = $_POST['phoneNumber']; // Phone number from the form

    // Insert payment details into the database
    $stmt = $conn->prepare("INSERT INTO payments (transaction_id, amount, phone_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $transactionId, $amount, $phoneNumber); // Binding parameters

    if ($stmt->execute()) {
        // Redirect to success page after successful payment record insertion
        header('Location: success_page.php');
        exit;
    } else {
        echo "Failed to insert payment record: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .payment-container {
            background: #fff;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo {
            background: #28a745; /* eSewa green color */
          /*  padding: 20px;
            text-align: center;
        }

        .logo img {
            max-width: 150px;
        }

        .form-container {
            padding: 30px;
        }

        .form-container h3 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #218838;
        }

        .form-container input[type="password"] {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="payment-container">
        <!-- Logo section -->
        <div class="logo">
            <img src="images/esewa.png" alt="eSewa Logo">
        </div>

        <!-- Form section -->
        <div class="form-container">
            <h3>Submit Payment Information</h3>
            <form action="payment_gateway.php" method="POST">
                <!-- Hidden fields for payment details -->
                <input type="hidden" name="amount" value="<?php echo $grand_total; ?>"> <!-- Pass dynamic amount -->
               <input type="hidden" name="transactionId" value="<?php echo $transactionId; ?>"> <!-- Pass unique transaction ID -->
                <!-- Phone number and password -->
                <input type="text" name="phoneNumber" placeholder="Enter your phone number (10 digits)" required pattern="\d{10}" title="Phone number must be 10 digits">
                <input type="password" name="password" placeholder="Enter your password" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>
