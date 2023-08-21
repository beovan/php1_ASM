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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ASSIGNMENT</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Change cart icon -->
  <link rel="stylesheet" href="css/cart_icon.css">
  <link rel="stylesheet" href="css/cart.css">
</head>

<body>
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
          < <div class="dropdown-content">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
            </nav>
            
        </div>
      
      
        </div>

       
          <!-- navbar -->
    </header>
    <!--Header-->
    <section>
      <div class="banner-father">
        <div class="row-home-banner">
          <div class="slider-text">
            <h2>We Care</h2>
            <span>Your Pets</span>
            <p>Lorem ipsum dolor sit amet, consectetur
              adipiscing elit, sed do eiusmod.</p>
            <a href="#">Contact us</a>
          </div>
          <div class="img-banner">
            <img class="reponsive-picture" src="img/dog.png.webp" alt="" />
          </div>
        </div>
      </div>
    </section>
    <!--Slider-->
  
      <section>
        <div class="area-home">
          <div class="container">
            <div class="collum-text-home">
              <div class="text-area-home">
                <h3>
                  Services for every dog
                </h3>
                <p>Lorem ipsum dolor sit , consectetur adipiscing elit, sed do
                  iusmod tempor incididunt ut labore et dolore magna aliqua.
                  Quis ipsum suspendisse ultrices gravida. Risus commodo
                  viverra maecenas accumsan.</p>
              </div>
            </div>
          </div>
          <div class="box-row-home">
            <div class="box-home ">
              <div class="background-orange">
                <div class="picture-area">
                  <img src="img/area/service_icon_1.png.webp" alt="">
                </div>
                </div>
              <div class="text-box-home">
                <h3>Pet Boarding</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
              
            </div>
            <div class="box-home ">
              <div class="background-orange">
                <div class="picture-area">
                  <img src="img/area/service_icon_2.png.webp" alt=""></div>
                </div>
              <div class="text-box-home">
                <h3>Healthy Meals</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
              
            </div>
            <div class="box-home ">
              <div class="background-orange">
                <div class="picture-area">
                  <img src="img/area/service_icon_3.png.webp" alt=""></div>
                </div>
              <div class="text-box-home">
                <h3>Pet Spa</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
              
            </div>
          </div>
        </div>
      
      
      </section><!--AREA HOME-->
      <?php 
    include("./layout/footer.php"); 
    ?>
    <!--Footer-->
    
  
</body>

</html>