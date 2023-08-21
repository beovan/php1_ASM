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


  if (isset($_SESSION['account_id'])) {
    //total
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`
    WHERE account_id ='$account_id' ")  or die("query failed");
    $grand_total = 0;
    $cart_number = 0;
    if (mysqli_num_rows($cart_query) > 0) {
        while ($fetch_cart_one = mysqli_fetch_assoc($cart_query)) {
            $sub_total = ($fetch_cart_one['price'] * $fetch_cart_one['quantity']) ; 
            $cart_number += $fetch_cart_one['quantity'];
            $grand_total += $sub_total;

        }
    }
   
    //total
    // If the 'account_id' key exists, assign it to the $account_id variable
    if (isset($_POST['checkout']) ) {
        $acc_username = $_POST['acc_username'];
        $acc_email = $_POST['acc_email'];
        $total = $_POST['total'];
        
        $address_ship = $_POST['address'];
        // Assuming you have a valid $account_id at this point
    
        // Insert into the 'order' table
        // $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE account_id = $account_id") or die("query failed");
        // var_dump(mysqli_query($conn, "SELECT * FROM `cart` WHERE account_id = $account_id"));
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE account_id = $account_id");
       
        if (mysqli_num_rows($select_cart) > 0) {
            $sql_insert_order = "INSERT INTO `order` (account_id, total, address_ship, status, created_by,created_at )
            VALUES ('$account_id', '$total', '$address_ship', 'Pending', '$acc_username'), " ;
        }
        else {
            header("Location:shopping_cart.php");
        }
        if ($conn->query($sql_insert_order) === TRUE) {
            // Order inserted successfully, get the newly inserted order_id
            $order_id = $conn->insert_id;
           
    
            // Now insert into the 'order_details' table for each cart item
            $select_cart_two = mysqli_query($conn, "SELECT * FROM `cart` WHERE account_id = $account_id  ") or die("query failed");
            while ($fetch_cart_two = mysqli_fetch_assoc($select_cart_two)) {
                
                $product_id = $fetch_cart_two['product_id'];
                $quantity = $fetch_cart_two['quantity'] ;
                $price = $fetch_cart_two['price'];

            
                $check_existing_query = "SELECT * FROM `order_details` WHERE order_id = $order_id AND product_id = $product_id";
                $existing_result = mysqli_query($conn, $check_existing_query);
        
                if (mysqli_num_rows($existing_result) > 0) {
                    // Update the quantity by adding the new quantity to the existing quantity
                    mysqli_query($conn, "UPDATE `order_details` SET quantity = quantity + $quantity 
                                         WHERE order_id = $order_id AND product_id = $product_id");
                } else {
                    // Insert a new row with the quantity
                    mysqli_query($conn, "INSERT INTO `order_details` (order_id, product_id, quantity, price)
                                         VALUES ($order_id, $product_id, $quantity, $price)");
                }
               
    
            
            }
            // Clear the cart after creating the order and order details
            $sql_clear_cart = "DELETE FROM `cart` WHERE account_id = $account_id";
            $conn->query($sql_clear_cart);

             // Now you can redirect the user to the order success page or display a success message
            header("Location: order_success.php");
            exit;
        }
    }
}
 else {
    // If the 'account_id' key doesn't exist, the user is not logged in
    // Handle the case when the user is not logged in
    echo ""; // or you can redirect the user to the login page here
}
  
 //Nên tách ra
//thêm giỏ hàng


//cập nhật giỏ hàng

 
 //tách ra từ đây 

 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="css/thongtintaikhoan.css">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/changeContainer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- chỉnh css mới (cart) -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/cart_icon.css">
    <link rel="stylesheet" href="css/checkout.css">
    <!-- Link w3 , font , font awesome -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <ul class="navbar-right">
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
        <?php

if (isset($message)) {
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}
?>
        <div class="container">
            <div class="row">
                <div class="col-75">
                    <div class="container">
                        <form action="" method="post">

                            <div class="row">
                                <div class="col-50">
                                    <h3>Billing Address</h3>
                                    <input type="hidden" name="total" value="<?php echo $grand_total; ?>">
                                    <label for="fname"><i class="fa fa-user"></i>Name</label>
                                    <input type="text" id="fname" name="acc_username" placeholder="Enter your name">
                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                    <input type="text" id="email" name="acc_email" placeholder="Enter your email">
                                    <label for="adr"><i class="fa fa-home"></i> Address</label>
                                    <input type="text" id="adr" name="address" placeholder="Enter your address">
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city" placeholder="Ho Chi Minh">

                                    <div class="row">
                                        <div class="col-50">
                                            <label class="fa fa-angle-down" for="state"> State</label>
                                            <input type="text" id="state" name="state" placeholder="HCMC">
                                        </div>
                                        <div class="col-50">
                                            <label class="fa fa-angle-down" for="zip"> Zip</label>
                                            <input type="text" id="zip" name="zip" placeholder="700000">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-50">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                                        <i class="fa fa-cc-paypal" style="color:blue;"></i>
                                        <i class="fa fa-cc-amex" style="color:green;"></i>
                                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <label class="	fa fa-vcard" for="cname"> Name on Card</label>
                                    <input type="text" id="cname" name="cardname" placeholder="card">
                                    <label class="	fa fa-slack" for="ccnum"> Credit card number</label>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="(+84) 385 806 448">
                                    <label class="fa fa-calendar-check-o" for="expmonth"> Exp Month</label>
                                    <input type="text" id="expmonth" name="expmonth" placeholder="July">

                                    <div class="row">
                                        <div class="col-50">
                                            <label class="fa fa-angle-down" for="expyear"> Exp Year</label>
                                            <input type="text" id="expyear" name="expyear" placeholder="2023">
                                        </div>
                                        <div class="col-50">
                                            <label class="fa fa-angle-down" for="cvv"> CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="352">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <label>
                                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as
                                billing
                            </label>
                            <input type="submit" value="Continue to checkout" class="btn" name="checkout">
                        </form>
                    </div>
                </div>

                <div class="col-25">
                    <div class="container">
                        <h4>Cart
                            <span class="price" style="color:black">
                                <i class="fa fa-shopping-cart"></i>
                                <b> <?php echo $cart_number ?></b>
                            </span>
                        </h4>
                        <?php   
                if (isset($_SESSION['account_id']))
                {
                  $cart_query = mysqli_query($conn, "SELECT * FROM `cart`
                  WHERE account_id ='$account_id' ")  or die("query failed");
                }
                 $grand_total = 0;
                
                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                ?>

                        <p><a href="#"><?php echo $fetch_cart['name'] ?></a> <span
                                class="price"><span><?php echo $fetch_cart['quantity']; ?> </span>x
                                <?php echo $fetch_cart['price'] ?></span></p>
                        <span><?php $sub_total = ($fetch_cart['price'] *
                                    $fetch_cart['quantity']) ; ?></span>
                        <?php 
                   $grand_total += $sub_total;
                }
             }else{
                echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
             } 
                        
                   ?>
                        <p>Total <span class="price" style="color:black"><b><?php echo  $grand_total; ?></b></span></p>
                        <!-- sửa phần total -->


                    </div>

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