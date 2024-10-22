<?php
session_start();
ob_start();
require 'components/config.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['user'])){

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
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
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
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<br><br><br><br>

<section class="form-container">

        <form class="" actions="" method="POST" autocomplete="off">
            <h3>Login Now</h3>
           <?php
            if (isset($error)) {
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
           
            <input type="text" id="user" name="user" required placeholder="Enter your Username " class="box" maxlength="50" 
            oninput="this.value= this.value.replace(/\s/g, '')">
            <input type="password" id="pass" name="pass" required placeholder="Enter your Password" class="box" maxlength="50" 
            oninput="this.value= this.value.replace(/\s/g, '')">
            <!-- <p>Forget your password <a href="#"> Click Here  </a></p> -->
            <p>Don`t have an account <a href="register.php"> Click Here  </a></p>
            <button type="submit" value="submit" name="submit" id="btnLogin" class="btn btn-submit" class="btn"> Login Now </button>
        </form>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="js/script.js?v=<?php echo time(); ?>"></script>

</body>
</html>