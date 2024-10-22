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
   $message[] = 'already sent message!';
}else{

   $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(NULL,?,?,?,?)");
   $insert_message->execute([$name, $email, $number, $msg]);

   $message[] = 'sent message successfully!';
   $insert_notif = $conn->prepare("INSERT INTO `notif` (`id`, `user_id`, `admin_id`, `riders_user`, `order_number`, `order_name`, `order_products`, `order_price`, `order_address`, `notify_rider`, `notify`, `status`, `from`) VALUES (NULL, ?, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ?, ?, ?);");
    $insert_notif->execute([$user_id, $notif, $status, $from]);
  
   //  $message[] = 'Notification!!!!';
}

}

?>