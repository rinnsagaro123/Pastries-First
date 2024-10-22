<?php
if(isset($_POST['send'])){

$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$number = $_POST['number'];
$number = filter_var($number, FILTER_SANITIZE_STRING);
$msg = $_POST['msg'];
$msg = filter_var($msg, FILTER_SANITIZE_STRING);
$notif = $_POST['notify'] . ' ' .$_POST['name'];
$notif = filter_var($notif, FILTER_SANITIZE_STRING);
$status = $_POST['status'];
$status = filter_var($status, FILTER_SANITIZE_STRING);
$from = $_POST['name'];
$from = filter_var($from, FILTER_SANITIZE_STRING);   


$select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
$select_message->execute([$name, $email, $number, $msg]);

if($select_message->rowCount() > 0){
   $message = 'already sent message!';
}else{
    if($user_id == ''){
        echo '<p class="empty">please login to see your orders</p>';
     }else{
   $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
   $insert_message->execute([$user_id, $name, $email, $number, $msg]);

//    $message[] = 'sent message successfully!';

  
    $insert_notif = $conn->prepare("INSERT INTO `notif` (`id`, `user_id`, `admin_id`, `riders_user`, `order_number`, `order_name`, `order_products`, `order_price`, `order_address`, `notify_rider`, `notify`, `status`, `from`) VALUES (NULL, ?, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ?, ?, ?);");
    $insert_notif->execute([$user_id, $notif, $status, $from]);
  
    $message[] = 'Notification!!!!';
    }
}

}

?>

<footer>
<section class="footer reveal">

    <div class="box-container">

        <div class="box">
            <h3> Pastries First <i class="fas fa-shopping-basket"></i> </h3>
            <p>
Discover how much importance we focus on making outstanding pastries with our passion and attention. To find out more, follow us on social media. Keep up to date and informed, Pastries First!</p>
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +123-456-7890 </a>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +111-222-3333 </a>
            <a href="#" class="links"> <i class="fas fa-envelope"></i> pastriesfirst@gmail.com </a>
            <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i> San Pedro Laguna, Philippines - 4023 </a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="home.php" class="links"> <i class="fas fa-arrow-right"></i> Home</a>
            <a href="contact.php" class="links"> <i class="fas fa-arrow-right"></i> Contacts </a>
            <a href="menu.php" class="links"> <i class="fas fa-arrow-right"></i> Menu </a>
            <a href="home.php#category" class="links"> <i class="fas fa-arrow-right"></i> Categories </a>
            <a href="about.php" class="links"> <i class="fas fa-arrow-right"></i> About Us</a>
        </div>

        <div class="box">
        <form action="" method="POST">
         <h3>tell us something!</h3>
        
         <input type="text" name="name" maxlength="50" class="email" placeholder="enter your name" required>
         <input type="number" name="number" min="0" max="9999999999" class="email" placeholder="enter your number" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="email" placeholder="enter your email" required>
         <textarea name="msg" class="email" required placeholder="enter your message" maxlength="500" cols="30" rows="1"></textarea>
         <input type="hidden" name="status" value="unseen"> 
         <input type="hidden" name="notify" value="There`s a new message"> 
         <input type="submit" value="send message" name="send" class="btn">
        </form>
        </div>
        
        </div>

    <div class="credit"> created by <span> Pastries First </span> | All Rights Reserved </div>




</section>

</footer>

<!-- <div class="loader">
   <img src="style/image/baking.gif" alt="">
</div> -->