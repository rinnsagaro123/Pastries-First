<?php

session_start();

ob_start();

include 'components/config.php';







if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

 }else{

    $user_id = '';

    header('location:home.php');

    ob_end_flush();

 };

 

 if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];

   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");

   $delete_order->execute([$delete_id]);

}



 if(isset($_POST['update_payment'])){



   $order_id = $_POST['order_id'];

   $payment_status = $_POST['payment_status'];

   $update_status = $conn->prepare("UPDATE `orders` SET order_number = ? WHERE user_id = ?");

   $update_status->execute([$order_id, $user_id]);  

   header("location: cancel_form.php");

     ob_end_flush();



}  

?>















<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pastries First| Orders</title>



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



<div class="heading"> 

    <h3> Products </h3>

    <p> <a href="home.php"> Home </a> <span> Order </span> </p>

</div>



<section class="orders">



   <h1 class="title">your orders</h1>



   <div class="box-container">



   <?php

      if($user_id == ''){

         echo '<p class="empty">please login to see your orders</p>';

      }else{

         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? order by id desc");

         $select_orders->execute([$user_id]);

         if($select_orders->rowCount() > 0){

            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

   ?>

   <div class="box">

   <?php

   if($fetch_orders['payment_status'] == 'Transit')

      { ?>

      <p>Order Number : <span><?= $fetch_orders['order_number']; ?></span></p>

      <?php

   } else if($fetch_orders['payment_status'] == 'Completed')

   { ?>

      <p>Order Number : <span><?= $fetch_orders['order_number']; ?></span></p>

      <?php

   } 

      ?>



      <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>

      <p>name : <span><?= $fetch_orders['name']; ?></span></p>

      <p>email : <span><?= $fetch_orders['email']; ?></span></p>

      <p>number : <span><?= $fetch_orders['number']; ?></span></p>

      <p>address : <span><?= $fetch_orders['address']; ?></span></p>

      <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>

      <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>

      <p>total price : <span>₱<?= $fetch_orders['total_price']; ?>/-</span></p>

      <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>

      <?php

      if($fetch_orders['payment_status'] == 'pending')

      { ?>

         <form action="" method="POST">

         <input type="hidden" name="oid" value="<?= $fetch_orders['id']; ?>">

         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

         <input type="hidden" value="cancelled" name="payment_status">

         <a href="order.php?delete=<?= $fetch_orders['id']; ?>" class="btn" onclick="return confirm('delete this order?');">delete</a>

         <input type="submit" value="Cancel Order" class="btn" name="update_payment">

      </form>

      <?php

      } else if($fetch_orders['payment_status'] == 'Cancelled') {

        

      ?>

      

      <p>Cancel Reason : <span><?= $fetch_orders['cancel_reason']; ?></span></p>

      <a href="order.php?delete=<?= $fetch_orders['id']; ?>" class="btn" onclick="return confirm('delete this order?');">delete</a>

      <?php

      }else

      {

         ?>

         <a href="order.php?delete=<?= $fetch_orders['id']; ?>" class="btn" onclick="return confirm('delete this order?');">delete</a>

      <?php

      }

      ?>

      

   </div>

   <?php

      }

      }else{

         echo '<p class="empty">no orders placed yet!</p>';

      }

      }

   ?>



   </div>



</section>



<?php include 'components/footer.php'; ?>



<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>



<script src="js/script.js?v=<?php echo time(); ?>"></script>

</body>

</html>