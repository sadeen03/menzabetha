<?php
session_start();
$bookLink = isset($_SESSION['email']) ? 'payment.php' : 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->

<section class="header">

   <a href="home.php" class="logo">منزبطهاا</a>

   <nav class="navbar">
      <a href="home.php">home</a>
      <a href="about.php">about</a>
      <a href="package.php">package</a>
      <a href="book.php">book</a>
      <a href="index.php">login</a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>travel all around JORDAN!</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>discover the new places</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>make your tour worthwhile</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>
         
      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- home section ends -->

<!-- services section starts  -->

<section class="services">

   <h1 class="heading-title"> our services </h1>

   <div class="box-container">
   <a href="trips.php" style="text-decoration: none; color: inherit;">
      <div class="box">
         <img src="images/trips.png" alt="">
         <h3>Trips</h3>
      </div>
</a>
<a href="hotels.php" style="text-decoration: none; color: inherit;">
      <div class="box">
         <img src="images/hotel.png" alt="">
         <h3>Hotels</h3>
      </div>
</a>
<a href="activites.php" style="text-decoration: none; color: inherit;">
      <div class="box">
         <img src="images/activity.png" alt="">
         <h3>Activites</h3>
      </div>
</a>
   </div>

</section>

<!-- services section ends -->

<!-- home about section starts  -->

<section class="home-about">

   <div class="image">
      <img src="images/about.jpg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>
      <a href="about.php" class="btn">read more</a>
   </div>

</section>

<!-- home about section ends -->

<!-- home packages section starts  -->

<section class="home-packages">

   <h1 class="heading-title"> our packages </h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <img src="images/rainbow.jpg" alt="">
         </div>
         <div class="content">
            <h3>Budget Weekend Escape</h3>
            <p>Perfect for a quick cultural hit! Wander through Amman’s downtown charm and explore the ancient Roman ruins of Jerash on a tight budget.</p>
            <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="images/petra.jpg" alt="">
         </div>
         <div class="content">
            <h3>Petra Explorer Pass</h3>
            <p>Unlock the wonders of Petra and enjoy a deep dive into the Rose City’s history. Ideal for couples or solo explorers looking for an iconic adventure.</p>
            <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

         </div>
      </div>
      
      <div class="box">
         <div class="image">
            <img src="images/aqaba.jpg" alt="">
         </div>
         <div class="content">
            <h3>Desert & Sea Adventure</h3>
            <p>Sleep under the stars in Wadi Rum and snorkel in the Red Sea. A balance of thrill and chill with a splash of Bedouin hospitality.</p>
            <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

         </div>
      </div>
      <div class="box">
         <div class="image">
            <img src="images/img-3.jpg" alt="">
         </div>
         <div class="content">
            <h3>Ultimate Jordan Journey</h3>
            <p>The full Jordanian experience! Culture, history, desert, sea, and everything in between. Your all-in-one travel subscription.</p>
            <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

         </div>
      </div>
      <div class="box">
         <div class="image">
            <img src="images/jarash.jpg" alt="">
         </div>
         <div class="content">
            <h3>Northern Nature Retreat</h3>
            <p>Connect with Jordan’s green side — from Ajloun’s forests to Umm Qais’ scenic views. A relaxed journey for culture lovers and peace seekers.</p>
            <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

         </div>
      </div>
   </div>

   <div class="more-details"> <a href="package.php" class="btn" style="display: block; margin: 20px auto;">more deatils </a> </div>

</section>

<!-- home packages section ends -->

<!-- home offer section starts  -->

<section class="home-offer">
   <div class="content">
      <h3>upto 50% off</h3>
      <p>if your a student at WISE join us now and get 50% off on your first book by us </p>
      <a href="<?php echo $bookLink; ?>" class="btn">book now</a>

   </div>
</section>

<!-- home offer section ends -->



<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +962788067797 </a>
         <a href="#"> <i class="fas fa-phone"></i> +962788067797</a>
         <a href="#"> <i class="fas fa-envelope"></i> danaawad34@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Amman, Jordan - 11118 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> created by <span>THE GIRLS</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>