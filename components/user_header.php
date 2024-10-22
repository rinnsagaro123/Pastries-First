<?php

ob_start();
include 'components/config.php';


if(isset($_POST['submitted'])){

   $order_id = $_POST['oid'];
   $user_id = $_POST['user_id'];
   $order_no =  $_POST['oid'];
  
   $payment_status = $_POST['payment_status'];
   $notif = $_POST['notify'];
   $notif = filter_var($notif, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $from = $_POST['from'];
   $from = filter_var($from, FILTER_SANITIZE_STRING);  
   $user = $_POST['user'];
   $user = filter_var($user, FILTER_SANITIZE_STRING); 
   $order_number = $_POST['order_number'];
   $order_number = filter_var($order_number, FILTER_SANITIZE_STRING); 
   $notify_rider = $_POST['notify_rider'];
   $notify_rider = filter_var($notify_rider, FILTER_SANITIZE_STRING); 
   
    
   
    
    

   $user_id = $_POST['user_id'];
   $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);  
   
   $update_notif = $conn->prepare("UPDATE `notification` SET `status` = 'seen' WHERE `notification`.`user_id` = ?");
   $update_notif->execute([$user_id]);

   $update_notif_rider = $conn->prepare("INSERT INTO `notif` (`id`, `user_id`, `admin_id`, `riders_user`, `order_number`, `order_name`, `order_products`, `order_price`, `order_address`, `notify_rider`, `notify`, `status`, `from`) VALUES (NULL, ?, NULL, NULL, ?, NULL, NULL, NULL, NULL, ?, ?, ?, ?);");
   $update_notif_rider ->execute([$user_id, $order_number, $notify_rider, $notif, $status, $from]);
  
   $delete_notif = $conn->prepare("DELETE FROM `notification` WHERE user_id = ?");
   $delete_notif->execute([$user_id]);    

   // header("location: pending_ship.php");

   header("location: order.php");
   ob_end_flush();

   
   }

   if(isset($_POST['delete'])){
      $cart_id = $_POST['cart_id'];
      $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $delete_cart_item->execute([$cart_id]);
      $message = 'cart item deleted!';
   }
   
   if(isset($_POST['delete_all'])){
      $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart_item->execute([$user_id]);
      // header('location:cart.php');
      $message = 'deleted all from cart!';
   }
   
   if(isset($_POST['update_qty'])){
      $cart_id = $_POST['cart_id'];
      $qty = $_POST['qty'];
      // $qty = filter_var($qty, FILTER_SANITIZE_STRING);
      $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
      $update_qty->execute([$qty, $cart_id]);
      $message = 'cart quantity updated';
   }
   
   $grand_total = 0;
   
   ?>


<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"> <img src="style/image/logo-new3.jpg" height="auto" class="logo"></a>

        <nav class="navbar">
            <a href="home.php">Home</a> 
            <a href="contact.php">Contact</a>
            <a href="menu.php">Menu</a>
            <a href="home.php#category">Categories</a>
            <a href="about.php">About Us</a>
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <a href="order.php">Order</a> 
         <?php
            }
            ?>
            
        </nav>

        <!-- <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"><a href="cart.php"><span>(3)</span></a>
            </div>
            <div id="user-btn" class="fas fa-user"> 
            </div>
        </div> -->

        <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars" ></div>
         <a href="search.php"><div class="fas fa-search" id="search-btn"></div></a>
         <div class="fas fa-shopping-cart" id="cart-btn"><span>(<?= $total_cart_items; ?>)</span></div>
         <?php
             $notification = $conn->prepare("SELECT * from `notification` Where user_id = ? and admin_id = 1 and status='unseen'");
             $notification->execute([$user_id]);
             $count_notif = $notification->rowCount();

            $select_profile = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
            $select_profile->execute([$user_id]);

            
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
           <div id="notif-btn" onclick="toggleNotif()" class="fa-solid fa-bell position-relative"><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">(<?= $count_notif; ?>)</span></div>

         <?php
            }
            ?>
         <div id="user-btn" class="fas fa-user"></div>
      </div>


   

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"> Welcome <?= $fetch_profile['name']; ?> </p>
                
                    <a href="profile.php" class="btn"> Profile </a>
                    <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="btn"> Logout </a>

              
         <?php
            }else{
         ?>
             <form action=""  actions="" method="POST" autocomplete="off" id="login-form" name="login-form">
            <h3>Login Now</h3>
            <input type="hidden" id="action" value="login">
            <input type="text" id="user" name="user" required placeholder="Enter your Username " class="box" maxlength="50" 
            oninput="this.value= this.value.replace(/\s/g, '')">
            <input type="password" id="pass" name="pass" required placeholder="Enter your Password" class="box" maxlength="50" 
            oninput="this.value= this.value.replace(/\s/g, '')">
            <!-- <p>Forget your password <a href="#"> Click Here  </a></p> -->
            <p>Don`t have an account <a href="register.php"> Click Here  </a></p>
            <button type="submit" onclick="submitData();" class="btn"> Login Now</button>
        </form>
            <!-- <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a> -->
         <?php
          }
         ?>
      </div>




      <div class="notification" id="notif-box">
          <div class="notif-item">

            
        <?php
              if($user_id == ''){
                echo '<p class="empty">please login first!</p>';
              }else
               {
               
                $notification = $conn->prepare("SELECT * from `notification` Where user_id = ? and admin_id = 1 and status='unseen'");
                $notification->execute([$user_id]);
                    if($notification->rowCount() > 0)
                    {
                    while($fetch_notif = $notification->fetch(PDO::FETCH_ASSOC)){

                    ?>
                    <div class="notif-boxes">


                        <form action="" method="POST">
                        <h3><span><?= $fetch_notif['notify']; ?></span></h3>
                        <h3><span>Order number: <?= $fetch_notif['order_number']; ?></span></h3>
                        
                        <input type="hidden" name="user_id" value="<?= $fetch_notif['user_id']; ?>">
                        <input type="hidden" name="notify_ship" value="<?= $fetch_notif['notify']; ?>"><form action="" method="POST"  class="box">

            
                        <input type="hidden" name="oid" value="<?= $fetch_notif['id']; ?>">
                        <input type="hidden" name="user_id" value="<?= $fetch_notif['user_id'];  ?>">
  

                       
                        
                        
                        
                        <input type="hidden" name="payment_status" value="To Receive">
                        <input type="hidden" name="notify" value="Your order is on its way">
                        <input type="hidden" name="notify_rider" value="You accepted the order! Here is the list of order">
                       
                        
                        <input type="hidden" name="admin_id" value="<?= $fetch_notif['admin_id']; ?>">
                        
                       
                        <input type="hidden" name="status" value="unseen">
                        <input type="hidden" name="user" value="<?= $fetch_notif['user_id']; ?>">
                        <input type="hidden" name="order_number" value="<?= $fetch_notif['id']; ?>">
                        <input type="hidden" name="from"   value="username: <?= $fetch_notif['user_id']; ?>, order number: <?= $fetch_notif['id']; ?>">
                        <input type="hidden" name="status" value="unseen">
                        <input type="submit" name="submitted" value="See" class="btn">
                    </form>
                    </div>
               <?php

                    }}
                    else {
                     
                        echo '<p class="empty-notif">no notification yet!</p>';
                    }
                  }
               ?>


         </div>
      </div>
        

<section class="shopping-cart">

<h1 class="title">Your cart</h1>
<?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
               while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
         ?>
      <div class="box-container">

        
         <form action="" method="post" class="box">
         
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-trash" name="delete" onclick="return confirm('delete this item?');"></button>
            <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
            <div class="name"><?= $fetch_cart['name']; ?></div>
               <div class="price"><span>₱</span><?= $fetch_cart['price']; ?></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                  <button type="submit" class="fas fa-edit" name="update_qty"></button>
            <div class="sub-total"> sub total : <span>₱<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
         </form>
         <?php
                  $grand_total += $sub_total;
               }
            }else{
               echo '<p class="empty">your cart is empty</p>';
            }
         ?>

      

      <div class="cart-total">
         <p>cart total : <span>₱<?= $grand_total; ?></span></p>
         <a href="cart.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to Cart</a>
      </div>

      <div class="more-btn">
         <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
         </form>
         <a href="menu.php" class="btn">Continue Shopping</a>
      </div>

      </div>

</section>

   </section>

       
 </header>




  <!-- <div class="profile">
            <p class="name"> Welcome   </p>
                <div class="flex1">

                    <a href="profile.php" class="btn"> Profile </a>
                    <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn"> Logout </a>

                </div>
        </div>

        <form action="" method="post" class="search-form">
            <input type="text" id="search-box" placeholder="Search here...">
            <label form="search-box" class="fas fa-search"></label>
            <button type="submit" name="search_btn" class="fas fa-search"> </button> 
        </form> -->
