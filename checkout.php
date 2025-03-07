<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}


if (isset($_POST['order_btn'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('Y-m-d H:i:s');
   



    $cart_total = 0;
    $cart_products = [];

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'order already placed!';
        } else {
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
            $message[] = 'order placed successfully!';

            // Update the quantity of each product in the products table
            foreach ($cart_products as $cart_product) {
                preg_match('/(.*?) \((\d+)\)/', $cart_product, $matches);
                $product_name = $matches[1];
                $product_quantity = $matches[2];

                $product_query = mysqli_query($conn, "SELECT quantity FROM `products` WHERE name = '$product_name'") or die('query failed');
                if ($product_query) {
                    $product = mysqli_fetch_assoc($product_query);
                    $new_quantity = $product['quantity'] - $product_quantity;

                    mysqli_query($conn, "UPDATE `products` SET quantity = '$new_quantity' WHERE name = '$product_name'") or die('query failed');
                }
            }
            date_default_timezone_set('Asia/Kathmandu');
            mysqli_query($conn, "SET time_zone = '+05:45'");

            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
    <h3>checkout</h3>
    <p><a href="home.php">home</a> / checkout</p>
</div>

<section class="display-order">

    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>
            <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rs.' . $fetch_cart['price'] . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
    <?php
        }
    } else {
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
    <div class="grand-total"> grand total : <span>Rs.<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

<form action="" method="post" id="checkoutForm">
    <h3>place your order</h3>
    <div class="flex">
        <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
        </div>
        <div class="inputBox">
            <span>Your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
        </div>
        <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
        </div>
        <div class="inputBox">
            <span>Payment method :</span>
            <select name="method" id="paymentMethod" required>
                <option value="cash on delivery">cash on delivery</option>
                <option value="e-sewa">e-sewa</option>
                <option value="paytm">paytm</option>
            </select>
        </div>
        <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
        </div>
        <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
        </div>
        <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
        </div>
        <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" required placeholder="e.g. Bagmati">
        </div>
        <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. Nepal">
        </div>
        <div class="inputBox">
            <span>Pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
        </div>
    </div>
    <input type="submit" value="order now" class="btn" name="order_btn">
</form>
</section>

<script>/*
    document.getElementById('checkoutForm').addEventListener('submit', function (e) {
        const paymentMethod = document.getElementById('paymentMethod').value;

        if (paymentMethod === 'e-sewa') {
            e.preventDefault(); // Prevent default form submission
            const formData = new FormData(this);

            // Redirect to payment_gateway.php with form data
            const queryParams = new URLSearchParams();
            formData.forEach((value, key) => {
                queryParams.append(key, value);
            });

            // Redirect to payment gateway
            window.location.href = `payment_gateway.php?${queryParams.toString()}`;
        }
    });
</script>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
