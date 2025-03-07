<?php
include 'config.php';
session_start();



if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        header('location:login.php');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_product_quantity = mysqli_query($conn, "SELECT quantity FROM `products` WHERE name = '$product_name'") or die('query failed');
    $fetch_quantity = mysqli_fetch_assoc($check_product_quantity);
    $available_quantity = $fetch_quantity['quantity'];

    if ($available_quantity == 0) {
        $message[] = 'Product is out of stock!';
    } elseif ($product_quantity > $available_quantity) {
        $message[] = "Only $available_quantity books are available in stock!";
    } else {
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>


<section class="home">
   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p>Welcome to the world of wisdom. Infinite possibilities await you. We are here to help you find the right book for you.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>
</section>

<section class="products">
   <h1 class="title">latest products</h1>
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
     <form action="" method="post" class="box">
        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
        <div class="name"><?php echo $fetch_products['name']; ?></div>
        <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
        <div class="quantity">Available: <?php echo $fetch_products['quantity']; ?></div>
        <input type="number" min="1" name="product_quantity" value="1" class="qty">
        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        <a href="description.php?id=<?php echo $fetch_products['id']; ?>" class="description-btn">Description</a>
     </form>
      <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
   </div>
   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>
</section>

<section class="about">
   <div class="flex">
      <div class="image">
         <img src="images/pexels-abby-chung-371167-1106468.jpg" alt="image">
      </div>
      <div class="content">
         <h3>about us</h3>
         <p>Welcome to our online bookstore, where we strive to fuel your passion for reading and learning. Our mission is to provide a vast, diverse, and handpicked selection of books that cater to all ages and interests. We believe that every book has the power to inspire, educate, and transform its reader, and we're committed to delivering those experiences to your doorstep. Our team is composed of book lovers who share a common goal of making books accessible and affordable for everyone. We carefully curate our collection, ensuring that we offer only the best and most relevant titles.</p>
         <a href="about.php" class="btn">read more</a>
      </div>
   </div>
</section>

<section class="home-contact">
   <div class="content">
      <h3>have any questions?</h3>
      <p>If you have any questions, please fill up the form below, we will get back to you as soon as possible.</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
