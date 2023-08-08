<?php

    require_once 'config.php';
    session_start();
    // Validation là quá trình để đảm bảo dữ liệu người dùng gửi lên là hợp lệ. 
    // Ví dụ ở trong PHP, bạn có thể dùng hàm mysql_real_escape_string()
    //để loại bỏ những kí tự có thể gây ảnh hưởng đến câu lệnh SQL.
    //The die() function is an alias of the exit() function.
    //Hàm md5() là hệ mã hóa một chiều, 
    //giúp mã hóa những thông tin quan trọng.
    // Trên thực tế chúng ta thường dùng để xây dựng mật khẩu của người dùng nhằm mục đích bảo mật, 
    //an toàn thông tin của tài khoản.
    //hash cũng mã hoá mật khẩu
    //header('location:' . $url);
    //header('Content-Type: text/html; charset=utf-8');
    //Trong đó: location là từ khóa bắt buộc để khai báo chuyển trang, 
    //$url là địa chỉ mà bạn muốn chuyển hướng tới.
   
    if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
      header("Location:Account_info.php");
    }
    else {
      $display_none_logout[] = "display: none";
    }
    if (isset($_POST['submit'])) {

      $username = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

        $select = mysqli_query($conn ,"SELECT * FROM `account` WHERE username='$username' 
        AND password = '$pass' " ) or die('query failed');
        if (mysqli_num_rows($select) > 0) {
         $row = mysqli_fetch_assoc($select); 
      
         $_SESSION['account_id'] = $row['account_id'];
          if ($row['role'] == 1) {
           header('location:Account_info.php');
            exit;
            
          }
          elseif($row['role'] == 0) {
            header('location: admin/admin_user.php');
            exit;
          }

        }
        else {
            $message[] = 'Sai username hoặc mật khẩu';
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/changeBackground.css">
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
        <a href="index.php
        "><img src="img/logo.png.webp" alt=""></a>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">           
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php
                    ">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.php
                    ">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="blog.php
                    ">Blog</a>
                  </li>    
                
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php
                    ">Contact</a>
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
    <div class="gutter">

    </div>
  </section>
  <section>
  <?php

if (isset($message)) {
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}

?>
<div class="form-container">


<form action="" method="post">
    <h3>Login</h3>
    <input type="text" class="box" name="username" required placeholder="username">   
    <input type="password" class="box" name="password" required placeholder="password">   
    <input type="submit" class="btn" name="submit" value="Login" >
    <p>No account? <a href="register.php">Register now</a></p> 

</form>
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