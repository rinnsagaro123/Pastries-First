<?php
session_start();
include 'components/config.php';

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };
 

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

    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">

</head>
<body>



<?php include 'components/user_header.php'; ?>



<section class="about">

   <div class="row">

      <div class="image">
         <img src="style/image/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>
Our company is sharing something close to our hearts in order to provide them with the best pastries they deserve.
 We believe that if it comes from the heart, nothing can possibly go wrong. We cherish and love our staff,
  teaching them how to prepare pastries with love and inspiring them to be the best versions of themselves,
   to be strong in the face of market diversity, and to thrive in innovation and opportunity. Therefore, 
   consumers can see the value we place on providing exceptional pastries with our utmost love and dedication.</p>
         <a href="menu.php" class="btn">our menu</a>
      </div>

   </div>

</section>



<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>