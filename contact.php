<?php
session_start();
include 'components/config.php';

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };

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

    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">


</head>
<body>



<?php include 'components/user_header.php'; ?>
<br><br><br><br>
<div class="heading"> 
    <h3> Pastries First </h3>
    <p> <a href="home.php"> Home </a> <span> Contact </span> </p>
</div>

<section class="contact">

   <div class="row">

      <div class="image">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.6037484651083!2d121.02713201483705!3d14.334434589972366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d6e09878739f%3A0x4e7bba7291cae75d!2sPolytechnic%20University%20of%20the%20Philippines%20%E2%80%93%20San%20Pedro%20Campus!5e0!3m2!1sen!2sph!4v1677332479261!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <form action="" method="post">
         <h3>tell us something!</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="enter your number" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
         <textarea name="msg" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
         <input type="hidden" name="status" value="unseen"> 
         <input type="hidden" name="notify" value="There`s a new message from:"> 

      </form>

   </div>

</section>




<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>