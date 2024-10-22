<?php
session_start();
ob_start();
include 'components/config.php';


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
    header('location:home.php');
    exit;
 };

//  if(isset($_POST['update_payment'])){

//     $order_id = $_POST['order_id'];
//     $payment_status = $_POST['payment_status'];
//     $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
//     $update_status->execute([$payment_status, $order_id]);
//     header("location: cancel_form.php");
 
//  }  

 if(isset($_POST['save_radio']))
 {


    $payment_status = $_POST['payment_status'];
    $cancel = $_POST['flexRadioDefault'];
    $order_number = $_POST['order_number'];

    $cancel_qry = $conn->prepare("UPDATE `orders` SET cancel_reason = ?, payment_status = ? where user_id = ? and order_number = ?");
    $cancel_qry->execute([$cancel, $payment_status, $user_id, $order_number]);
    header("location: order.php");
    ob_end_flush();

 }


 if(isset($_POST['go_back']))
 {
    header("Location: order.php");
     ob_end_flush();
 }
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastries First | Checkout</title>

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

<br><br><br><br>
<br><br><br><br>

<?php include 'components/user_header.php'; ?>
<section class="cancel-form">
<?php

$order_qry = $conn->prepare("SELECT id FROM `orders` order by id DESC LIMIT 1");
$order_qry->execute();
$order_number = $order_qry->fetch(PDO::FETCH_ASSOC);

?>


<div class="box-container">
    <div class="box">
    <h1> Order Number: <?=$order_number['id']; ?> </h1>

    <form action="" method ="POST">
    <input type="hidden" name="order_id" value="<?= $order_number['id']; ?>">
    <input type="hidden" value="Cancelled" name="payment_status">
    <input type="hidden" name="order_number" value="<?=$order_number['id']; ?>">
    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Want to Change Payment Method">
    <label class="form-check-label" for="flexRadioDefault1">
        Want to Change Payment Method
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Change/Combine Order" >
    <label class="form-check-label" for="flexRadioDefault2">
       Change/Combine Order
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Duplicate Order" >
    <label class="form-check-label" for="flexRadioDefault2">
       Duplicate Order
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Sourcing Payment Issue" >
    <label class="form-check-label" for="flexRadioDefault2">
       Sourcing Payment Issue
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Change of mind">
    <label class="form-check-label" for="flexRadioDefault2">
        Change of mind
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Decided for alternative product" >
    <label class="form-check-label" for="flexRadioDefault2">
        Decided for alternative product
    </label>
    </div>

    <div class="form-check">
    <button type="submit" name="save_radio" class="btn btn-primary"> Cancel Order </button>
    <button type="submit" name="go_back" class="btn btn-primary"> Go Back </button>
    </div>
    </div></div>
</section>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" 
integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/6e4c95bbe7.js" crossorigin="anonymous"></script>
<script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>