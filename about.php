<?php

include 'config.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/book1.avif" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
        <p>We're more than just an online store. we're a community of readers who share the joy of discovering new worlds, ideas, and stories.
          We invite you to join us in our journey, where we celebrate the magic of books and the power of imagination.?
          We also prioritize the needs and preferences of our customers, constantly seeking ways to improve their browsing and shopping experience.
          Thank you for being a part of our story.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/nirman.jpg " alt="">
         <p>Hello! I found ordering books from books paradise is quite simple and easy.
            The service is aslo really fast.Great online book store.
         </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nirman Tamang</h3>
      </div>

      <div class="box">
         <img src="images/neha.jpg" alt="">
         <p>If you are book lovers , you are at right place.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Neha Sapkota</h3>
      </div>

      <div class="box">
         <img src="images/nita.jpg" alt="">
         <p>I found all latest books here.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nita Shrestha</h3>
      </div>

      <div class="box">
         <img src="images/sh.jpg" alt="">
         <p>My daughter is fond of reading books and I am happy that I found this amazing website.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Shomee Lama</h3>
      </div>

      <div class="box">
         <img src="images/binita.jpg" alt="">
         <p>Amazing bookstore website. </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Binita Katwal</h3>
      </div>

      <div class="box">
         <img src="images/sangay.jpg" alt="">
         <p>The delivery of products is really fast. And the delivery person is also very polite.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sangay Sherpa</h3>
      </div>

   </div>
   

</section>

<section class="authors">

   <h1 class="title">great authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/roald-dahl.jpg" alt="">
         <div class="share">
            <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <h3>Roald-dahl</h3>
      </div>

      <div class="box">
         <img src="images/subin bhattarai.jpg" alt="">
         <div class="share">
            <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
            <a href= "https://www.linkedin.com/feed/"class="fab fa-linkedin"></a>
         </div>
         <h3>Subin Bhattarai</h3>
      </div>

      <div class="box">
         <img src="images/JK Rowling.jpg" alt="">
         <div class="share">
            <a href= "https://www.facebook.com/"class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/"  class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <h3>JK Rowling</h3>
      </div>

      <div class="box">
         <img src="images/Chetan Bhagat.jpg" alt="">
         <div class="share">
         <a href= "https://www.facebook.com/chetanbhagat.fanpage/"class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/"  class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <h3>Chetan BHagat</h3>
      </div>

      <div class="box">
         <img src="images/Amar Neupanw.jpg" alt="">
         <div class="share">
         <a href= "https://www.facebook.com/"class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/"  class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <h3>Amar Neupane</h3>
      </div>

      <div class="box">
         <img src="images/rabindra.jpg" alt="">
         <div class="share">
         <a href= "https://www.facebook.com/"class="fab fa-facebook-f"></a>
            <a href="https://x.com/?lang-en=" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/"  class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/feed/" class="fab fa-linkedin"></a>
         </div>
         <h3>Rabindra Mishra</h3>
      </div>

   </div>

</section>

<section class="faq">

   <h1 class="title">frequently asked questions</h1>

   <div class="box-container">

            </div>

      <div class="box">
         <h3>How long does shipping take?</h3>
         <p>Shipping times vary depending on your location and the shipping method chosen.
            On average, standard shipping takes 5-7 business days, while expedited shipping takes 2-3 business days.
         </p>
      </div>

      

      <div class="box">
         <h3>How do I contact customer support?</h3>
         <p>For customer support inquiries, you can reach out to us via email at [email protected]
            or use the contact form available on our 'Contact Us' page. We're here to help!
         </p>
      </div>

   </div>

</section>












<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
