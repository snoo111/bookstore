
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
         <a href= "https://www.facebook.com/"class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/"  class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">Login</a> | <a href="register.php">Register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Book Paradise</a>

         <nav class="navbar">
            <a href="home.php" class="button">Home</a>
            <a href="about.php" class="button">About</a>
            <a href="shop.php" class="button">Shop</a>
            <a href="contact.php" class="button">Contact</a>
            <a href="orders.php" class="button">Orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>

            <?php if(isset($_SESSION['user_id'])) : ?>
                <!-- Show user box if user is logged in -->
                <div id="user-btn" class="fas fa-user" data-toggle="modal" data-target="#user-box"></div>
                
<div class="user-box">

<p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
      </div>


   <script>
document.addEventListener("DOMContentLoaded", function() {
    var userBtn = document.getElementById('user-btn');
    var userBox = document.querySelector('.user-box');

    // Toggle user box when user button is clicked
    userBtn.addEventListener('click', function() {
        userBox.classList.toggle('active');
    });

    // Close user box when clicking outside of it
    document.addEventListener('click', function(event) {
        if (!userBox.contains(event.target) && !userBtn.contains(event.target)) {
            userBox.classList.remove('active');
        }
    });
});

</script>
                <?php
                   $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                   $cart_rows_number = mysqli_num_rows($select_cart_number); 
                ?>
                <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
            <?php else : ?>
                <!-- Display login/register links if user is not logged in -->
                <div>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            <?php endif; ?>
         </div>
      </div>
   </div>


   


</div>
</header>
</html>
