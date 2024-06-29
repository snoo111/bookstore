<!-- description.php -->
<?php
include 'config.php';

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $select_product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
    if(mysqli_num_rows($select_product_query) > 0) {
        $product = mysqli_fetch_assoc($select_product_query);
    } else {
        // Handle product not found
        echo "Product not found";
    }
} else {
    // Handle no product ID provided
    echo "No product ID provided";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <h1><?php echo $product['name']; ?></h1>
    <p class = "productDescription"><?php echo $product['description']; ?></p>

    
</body>
</html>
