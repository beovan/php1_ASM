<?php
include("./config.php");
session_start();
if (isset($_SESSION['account_id'])) {
$account_id = $_SESSION['account_id'];
    $display_none[] = "display: none;";
  }
  else {
    $display_none_logout[] = "display: none";
  }
// Check if the 'account_id' key exists in the session
if (isset($_SESSION['account_id'])) {
    // If the 'account_id' key exists, assign it to the $account_id variable
    $account_id = $_SESSION['account_id'];

    include("./add_product.php");
    
} else {
    // If the 'account_id' key doesn't exist, the user is not logged in
    // Handle the case when the user is not logged in
    echo ""; // or you can redirect the user to the login page here
}

if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql_products = "SELECT products.*, categories.name AS category_name 
    FROM products 
    INNER JOIN categories ON products.category_id = categories.category_id 
    WHERE product_id = '$product_id'";
    $result_products = $conn->query($sql_products);
    $fetch_product = $result_products->fetch_assoc();
    
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- chỉnh css mới (cart) -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/cart_icon.css">
    <link rel="stylesheet" href="css/product_details.css">
</head>

<body>
    <header>
    <?php 
    include ("./layout/header_top.php");
    ?>
        <div class="header-bottom">
            <div class="row-header-bottom">
                <a href="index.php"><img src="img/logo.png.webp" alt=""></a>
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsibleNavbar" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                            aria-label="Toggle navigation">
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
                        </div>
                        <ul class="navbar-right list-group">
                            <li><a href="./shopping_cart.php" id="cart"><i class="fa fa-shopping-cart"></i> Cart <span
                                        class="badge">3</span></a></li>
                        </ul>
                        <!--end navbar-right -->
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

        <div class="container">
            <?php

if (isset($message)) {
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}
?>
            <div class="products">

                <h1 class="heading">Product</h1>




                <div class="row">

                    <div class="left col-md-6">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <img class="headset" src="images/<?php echo $fetch_product['image']; ?>">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </div>

                    <div class="right col-md-6">
                        <h4 class="categorie"><?php echo $fetch_product['category_name']; ?></h4>
                        <h3 class="product"><?php echo $fetch_product['name']; ?></h3>
                        <div class="desc">
                            <?php echo $fetch_product['description']; ?>
                        </div>
                        <!-- Phần màu sắc làm sau  -->
                        <!-- <div class="color">
       <p class="title-colour">Color : <span class="blackwhite">Black</span></p>
       <i class="color-black fa fa-check" aria-hidden="true"></i>
       <i class="color-white fa fa-check" aria-hidden="true"></i>
                            </div> -->

                        <p class="price"> <?php echo $fetch_product['price']; ?>đ</p>
                        <form class="form-inline form" action="" method="post">
                            <div class="form-group">
                            <label for="quantity">Quanity :</label>
                            </div>
                          
                            <input type="number" min="1" name="product_quantity" value="1">
                            <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?> ">
                        <!-- id -->
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?> ">
                            <!-- ảnh -->
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?> ">
                            <!-- tên -->
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?> ">
                            <div class="form-group">
                            <input type="submit" name="add_to_cart" class="btn btn-primary mb-2" value="Buy now"></input>
                            </div>

                        </form>

                    </div>
                    <!-- Lấy thông tin vô giỏ hàng -->


                </div>
            </div>
        </div>
    </section>
    <!--Slider-->


    <?php 
    include("./layout/footer.php"); 
    ?>
    <!--Footer-->
</body>

</html>