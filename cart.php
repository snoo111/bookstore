<?php
session_start();
include 'config.php';

// Ensure user is logged in
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

// Check if payment was successful (via session variable)
if (isset($_SESSION['payment_successful']) && $_SESSION['payment_successful'] === true) {
    // Empty the cart after payment
    $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    // Clear the payment_successful session variable to prevent further actions
    unset($_SESSION['payment_successful']);

    // Redirect to homepage or success page
    header('Location: home.php');
    exit;
}

// Update cart quantity
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('Query failed');
    header('Location: cart.php');
    exit;
}

// Delete item from cart
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('Query failed');
    header('Location: cart.php');
    exit;
}

// Delete all items from cart
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Shopping Cart</h3>
        <p><a href="home.php">Home</a> / Cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">Products Added</h1>

        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
                <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price">Rs.<?php echo $fetch_cart['price']; ?>/-</div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_cart" value="Update" class="option-btn">
                </form>
                <div class="sub-total">Sub total: <span>Rs.<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span></div>
            </div>
            <?php
                $grand_total += $sub_total;
                    }
                } else {
                    echo '<p class="empty">Your cart is empty.</p>';
                }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete All</a>
        </div>

        <div class="cart-total">
            <p>Grand Total: <span>Rs.<?php echo $grand_total; ?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue Shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>
