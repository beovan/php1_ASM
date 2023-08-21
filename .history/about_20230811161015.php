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
  <title>About</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
   <!-- chỉnh css mới (cart) -->
   <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/cart_icon.css">
</head>

<body >
  <header>
    <?php 
    include ("./");
    ?>
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
            </div>
          </nav>
          
      </div>
    
    
      </div>

     
        <!-- navbar -->
  </header>
  <!--Header-->
  <section>
    <div class="banner-about">
      <div class="row">
        <h3 class="about-text-banner">About Us</h3>
      </div>
    </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row-text-about">
        <img src="./img/pet_care.png.webp" alt="">
        <div class="text-area">
          <video width="400px" controls >
            <source src="video/medical care dog.mp4" >
          </video>
          <h3>
            <span>We care your pet</span>
            <br>
            As you care
          </h3>
          <p>Lorem ipsum dolor sit , consectetur adipiscing elit, sed do
            iusmod tempor incididunt ut labore et dolore magna aliqua.
            Quis ipsum suspendisse ultrices gravida. Risus commodo
            viverra maecenas accumsan.</p>
          <a id="about-btn" href="#">About Us</a>
         
          

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