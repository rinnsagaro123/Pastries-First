<?php
session_start();
require 'components/config.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST["action"]))
{
   if($_POST["action"] == "login"){
      login();
   }
}

function login()
{
   global $conn;

   $user = $_POST['user'];
   $user = filter_var($user, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `user` WHERE user = ?");
   $select_user->execute([$user]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION["login"] = true;
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
      ob_end_flush();
   }else{
     echo  "incorrect username or password!";
     exit;
   }

}
?>