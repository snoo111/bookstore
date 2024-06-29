<?php
include 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $description = $_POST['description'];
    
    // Update or insert description for the product
    $sql = "INSERT INTO product_descriptions (product_id, description) VALUES ('$product_id', '$description') ON DUPLICATE KEY UPDATE description = '$description'";
    mysqli_query($conn, $sql);
}

// Fetch products from database
$products_query = mysqli_query($conn, "SELECT * FROM products");
$products = mysqli_fetch_all($products_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product Descriptions</title>
</head>
<body>
    <h1>Admin - Product Descriptions</h1>
    <form method="post">
        <label for="product_id">Select Product:</label>
        <select name="product_id" id="product_id">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="description">Product Description:</label>
        <textarea name="description" id="description" rows="4" cols="50"></textarea>
        <br>
        <button type="submit">Save Description</button>
    </form>
</body>
</html>
