<?php
  include 'config.php';
  session_start();

  if (isset($_SESSION['account_id'])) {
  $account_id = $_SESSION['account_id'];

    $display_none[] = "display: none;";
  }
  else {
    $display_none_logout[] = "display: none";
  }

  
 //Nên tách ra
//thêm giỏ hàng


//cập nhật giỏ hàng
if(isset($_POST['update_cart'])){
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE cart_id = '$update_id'") or die('query failed');
    $message[] = 'cart quantity updated successfully!';
 }
 //xoá giỏ hàng
 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE cart_id = '$remove_id'") or die('query failed');
    header('location:shopping_cart.php');
 }
 //xoá hết giỏ hàng
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE account_id = '$account_id'") or die('query failed');
    header('location:shopping_cart.php');
 }
 
 //tách ra từ đây 
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart</title>
  <link rel="stylesheet" href="css/thongtintaikhoan.css">
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/changeContainer.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- chỉnh css mới (cart) -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/cart_icon.css">

</head>

<body >
  <header>
    <div class="header-top">
      <div class="row-header-top">
        <div class="contact-info ">
          <ul>
            <li><a class="disabled" href="#">+880 4664 216</a></li>
            <li><a class="disabled" href="#">Mon - Sat 10:00 - 7:00</a></li>
          </ul>
        </div>

        <div class="social-icon">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-pinterest"></i></a>
          <a href="#"><i class="bi bi-google"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
        </div>
        <div class="dropdown">
        <button id="menuUsername" class="dropbtn"><?php 
          if (isset($_SESSION['account_id'])) {
            include("./excute_account_info.php");
            echo $fetch_user['username'];
          }
          else {
            echo "Account";
          }
          
          ?></button>
        <div class="dropdown-content">
            <a style="<?php foreach($display_none as $value) {echo $value;};?>" href="login.php" id="loginBtn">Login</a>
            <a style="<?php foreach($display_none_logout as $value) {echo $value;};?>" href="Account_info.php" id="account_info"  >account info</a>
            <a id="logoutButton" onclick="logout()" style="display: none;">logout</a>
            <a style="<?php foreach($display_none as $value) {echo $value;};?>" href="register.php" id="registerBtn">register</a>
            
          </div>
        </div>

      </div>


    </div>
    <div class="header-bottom">
      <div class="row-header-bottom">
        <a href="index.php"><img src="img/logo.png.webp" alt=""></a>
        <nav class="navbar navbar-expand-lg ">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blog.php">Blog</a>
                </li>    
              
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>  
                <li class="nav-item">
                      <a class="nav-link" href="shop.php">Shop</a>
                </li>
                </div>   <ul class="navbar-right">
      <li><a href="./shopping_cart.php" id="cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">3</span></a></li>
    </ul> <!--end navbar-right -->
              </ul>
            </div>
          </div>
        </nav>
      </div>


    </div>


    <!-- navbar -->
  </header>
  <!--Header-->
  <section>
   <?php

if (isset($message)) {
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}
?>
    <div class="container">

       
        

        <div class="shopping-cart">

            <h1 class="heading">Shopping cart</h1>

            <table>
                <thead>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>price</th>
                    <th>quanlity</th>
                    <th>Total</th>
                    <th>action</th>
                </thead>
                <tbody>
                <?php   
                $grand_total = 0;
                if (isset($_SESSION['account_id']))
                {
                  $cart_query = mysqli_query($conn, "SELECT * FROM `cart`
                  WHERE account_id ='$account_id' ")  or die("query failed");
                }
                else {
                  $cart_query = mysqli_query($conn, "SELECT * FROM `cart`
                  WHERE account_id = 0 ")  or die("query failed");
                }
               
                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                ?>
                <tr>
                    <td><img src="images/<?php echo $fetch_cart['image'] ?>" height="100"  width="100" alt=""></td>
                    <td><?php echo $fetch_cart['name'] ?></td>
                    <td><?php echo $fetch_cart['price'] ?>đ</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">

                            <input type="number" min="1" name="cart_quantity" 
                            value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" name="update_cart" value="update" class="option-btn">
                        </form>
                    </td>
                    <td><?php echo $sub_total = ($fetch_cart['price'] *
                     $fetch_cart['quantity']) ; ?>đ</td>
                     <td><a href="shopping_cart.php?remove=<?php echo $fetch_cart['cart_id']; ?>" 
                     class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
                </tr>
                <?php
         $grand_total += $sub_total;
        //  lưu id cart 
        
       
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Total: </td>
         <td><?php echo $grand_total; ?>đ</td>
         <td><a href="shopping_cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total >= 1)?'':'disabled'; ?>">delete all</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="checkout.php" class="btn <?php echo ($grand_total >= 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>


        </div>

    </div>
  </section>

  <!--Slider-->
  <section>
    <div class="gutter">
    </div>
  </section>

  <?php 
    include("./layout/footer.php"); 
    ?>
  <!--Footer-->

</body>

</html>