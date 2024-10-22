<?php

session_start();
ob_start();
include 'components/config.php';



if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };
 
 include 'components/add_cart.php';

 include 'components/message.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastries First</title>

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">

</head>
<body>





<?php include 'components/user_header.php'; ?>
<section class="hero" id="hero">


<div class="content"> 

      <h1>Remember  <span> Pastries First! </span> </h1>
      <p> Check out our newest, freshly made pastries! It is made with our utmost love and care.</p>
</div> 

<div class="btn">
<a href="home.php#category"> Shop Now </a> 
</div>


<video autoplay loop muted plays-inline class="back-video">
  <source src="style/image/video-bg.mp4" type="video/mp4">
</video>
</section>


<section class="categories" id="category">

    <h1 class="heading reveal"> Food <span>Categories</span> </h1>

    <div class="box-container reveal">

        <div class="box">
            <img src="style/image/Categories/bread.png" alt="">
            <h3>Bread</h3>
            <p></p>
            <a href="category.php?category=Bread" class="btn">Shop Now</a>
        </a></div>

        <div class="box">
            <img src="style/image/Categories/cake.png" alt="">
            <h3>Cake</h3>
            <p></p>
            <a href="category.php?category=Cake" class="btn">Shop Now</a>
        </div>

        <div class="box">
            <img src="style/image/Categories/cookie.png" alt="">
            <h3>Cookies</h3>
            <p></p>
            <a href="category.php?category=Cookie" class="btn">Shop Now</a>
        </div>

        <div class="box">
            <img src="style/image/Categories/Donuts.png" alt="">
            <h3>Donuts</h3>
            <p></p>
            <a href="category.php?category=Donuts" class="btn">Shop Now</a>
        </div>
        <div class="box">
            <img src="style/image/Categories/cupcake.png" alt="">
            <h3>Cupcake</h3>
            <p></p>
            <a href="category.php?category=Cupcake" class="btn">Shop Now</a>
        </a></div>
        <div class="box">
            <img src="style/image/Categories/muffin.png" alt="">
            <h3>Muffin</h3>
            <p></p>
            <a href="category.php?category=Muffin" class="btn">Shop Now</a>
        </a></div>
        <div class="box">
            <img src="style/image/Categories/pie.png" alt="">
            <h3>Pie</h3>
            <p></p>
            <a href="category.php?category=Pies" class="btn">Shop Now</a>
        </a></div>

    </div>

</section>

<!-- category section  -->

<!-- product section  -->


<section class="products">

   <<h1 class="heading reveal"> Latest <span> Pastries </span> </h1>

   <div class="box-container reveal">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>₱</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">View All</a>
   </div>

</section>




<!-- product section  -->

 <!-- features section -->

<section class="features" id="features">

<h1 class="heading reveal"> Our <span> Features </span> </h1>

<div class="box-container reveal">


    <div class="box"> 
        <img src="style/image/feature-img-1.png" alt="">
        <h3> Customize your pastries</h3>
        <p> Solid Made in Aluminum bread to AHAAHHAHAHAHHA </p>
        <a href="#" class="btn"> READ MORE </a>
    </div>

    <div class="box"> 
        <img src="style/image/feature-img-2.png" alt="">
        <h3> Packaging and Delivery </h3>
        <p> Kahit di ka umorder libreee na </p>
        <a href="#" class="btn"> READ MORE </a>
    </div>

    <div class="box"> 
        <img src="style/image/feature-img-3.png" alt="">
        <h3> Payment Method</h3>
        <p> Napakadaliii langggg kaya gora na</p>
        <a href="#" class="btn"> READ MORE </a>
    </div>


</div>

</section>

<!-- features section  -->


<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="js/script.js?v=<?php echo time(); ?>"></script>

</body>
</html>