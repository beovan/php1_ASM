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
  <title>Contact</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="./css/contact.css">
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
    include ("./layout/header_top.php");
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
    <div class="gutter">

    </div>
  </section>
  <section>
    <div class="banner-blog">
        <div class="center-blog">
            <h1>Contact</h1>
        </div>
    </div>
  </section>
  <section>
    <div class="gutter">

    </div>
  </section>
  <section>
    <div class="container">
      <div class="iframeMap">
        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.054809046526!2d108.07245781071683!3d12.709845720511128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3171f7d129f29e75%3A0x4a950c104f61c8bb!2sFPT%20Polytechnic%20T%C3%A2y%20Nguy%C3%AAn!5e0!3m2!1sen!2s!4v1685918490459!5m2!1sen!2s"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <button id="Show-location" onclick="hienThi()">Show location</button>
      </div>
    <div class="content-contact">
        <div class="content-contact-left">
            <form class="form-contact">
                <h2>Get in touch</h2>
                <textarea class="textarea-contact" cols="30" rows="9"></textarea>
                <input type="text" placeholder="Enter your name" >
                <br>
                <input type="email" placeholder="Enter your email">
                <br>
                <input type="text" placeholder="Enter Subject" >
            </form>

        </div>
        <div class="content-contact-right">
           
            
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
  <script src="js/geolocation.js"></script>
</body>

</html>