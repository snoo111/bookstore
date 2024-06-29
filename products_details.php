

<?php
/*
// Include necessary files and start session if required
include 'config.php';
session_start();

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Query to fetch product details using the provided ID
    $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
    
    // Check if the query executed successfully and product exists
    if(mysqli_num_rows($product_query) > 0) {
        $product = mysqli_fetch_assoc($product_query);
        // Display product details
        echo "<h1>{$product['name']}</h1>";
        echo "<img src='uploaded_img/{$product['image']}' alt='{$product['name']}'><br>";
        echo "Price: Rs. {$product['price']}<br>";
        // Add more details as needed
    } else {
        echo "Product not found!";
    }
} else {
    echo "Product ID not provided!";
}
?>
*/
