<?php

session_start();
ob_start();
include '../components/config.php';


$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
}


if(isset($_POST['save_radio']))
{

   $payment_status = $_POST['payment_status'];
   $cancel = $_POST['flexRadioDefault'];
   $order_number = $_POST['order_number'];
   $user_id = $_POST['user_id'];

   $cancel_qry = $conn->prepare("UPDATE `orders` SET cancel_reason = ?, payment_status = ? where admin_id = ? and order_number = ?");
   $cancel_qry->execute([$cancel, $payment_status, $admin_id, $order_number]);

   header("location: product_approve.php");
   exit;
//   ob_end_flush();


}


if(isset($_POST['go_back']))
{
   header("Location: product_approve.php");
//   ob_end_flush();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Decline Form</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../style/admin_style.css?v=<?php echo time(); ?>">

</head>
<body>

<?php include '../components/admin_header.php' ?>

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
    <input type="hidden" name="user_id" value="<?= $fetch_orders['user_id']; ?>">
    <input type="hidden" name="order_id" value="<?= $order_number['id']; ?>">
    <input type="hidden" value="Cancelled" name="payment_status">
    <input type="hidden" name="order_number" value="<?=$order_number['id']; ?>">
    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Out of stock">
    <label class="form-check-label" for="flexRadioDefault1">
        Out of stock
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Buyer Shipping address is incorrect/Incomplete/wrongly selected" >
    <label class="form-check-label" for="flexRadioDefault2">
    Buyer Shipping address is incorrect/Incomplete/wrongly selected
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Buyer requested due to Duplicate order" >
    <label class="form-check-label" for="flexRadioDefault2">
       Buyer requested due to Duplicate order
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Buyer requested due to change of mind" >
    <label class="form-check-label" for="flexRadioDefault2">
       Buyer requested due to change of mind
    </label>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" value="Buyer unreachable for order validation">
    <label class="form-check-label" for="flexRadioDefault2">
        Buyer unreachable for order validation
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
<script src="../js/admin_script.js?v=<?php echo time(); ?>"></script>

</body>
</html>