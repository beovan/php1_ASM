<?php
  include 'config.php';
  session_start();
  include_once("./");
  if (isset($_SESSION['account_id'])) {
    $display_none[] = "display: none;";
  }
  else {
    $display_none_logout[] = "display: none";
  }

  if (isset($_POST['submit_change'])) {
    $message[] = "";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    if (empty($username) || trim($username) === '' ||   trim($email) === '' ){
    $message[] = "Please enter a username and email address";
    }
    if (trim($pass) === '' || trim($cpass) === '') {
        $message[] = "Please enter passwords";
    }
    else {
        $account_id = $_POST['account_id'];

    $sql = "UPDATE account SET username = '$username' , email = '$email', password = '$pass' WHERE account_id = '$account_id'";
    if ($conn->query($sql)) {
        $message[] = "<span class='text text-success'>Updated successfully</span>";
    } else {
        $message[] = "<span class='text text-danger'>Error updating record: " . $conn->error . "</span>";
    }
    }
    
}
// xuat ra thong tin va thay doi

 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="css/thongtintaikhoan.css">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- chỉnh css mới (cart) -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/cart_icon.css">

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

            <div class="user-profile">




                <p> Tên tài khoản : <span><?php echo $fetch_user['username']; ?> </span> </p>
                <p> Email : <span><?php echo $fetch_user['email']; ?> </span> </p>
                <form class="flex" method="post">
                    <a href="Account_info.php?logout=<?php echo $account_id; ?>"
                        onclick="return confirm('Bạn đang muốn đăng xuất?');" class="delete-btn">logout</a>

                    <!-- start -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add user information</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form class="form-inline " action="" method="POST">
                                        <input type="hidden" name="account_id"
                                            value="<?php echo $fetch_user['account_id']; ?>">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="<?php echo $fetch_user['username']; ?>">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo $fetch_user['email']; ?>">
                                        <label for="password">password</label>
                                        <input type="text" class="form-control" name="password" value="">
                                        <label for="confilm password">confilm password</label>
                                        <input type="text" class="form-control" name="cpassword" value="">
                                        <button type="submit" class="btn btn-primary mb-2" name="submit_change">Save
                                            Changes</button>
                                    </form>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </form>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Change user information
                </button>
            </div>

            <table class="table table-hover">
                <thead class="thead-primary">
                    <tr>
                        <th class="alert" scope="col">Name</th>
                        <th class="alert" scope="col">quantity</th>
                        <th class="alert" scope="col">Price</th>
                        <th class="alert" scope="col">address ship</th>
                        <th class="alert" scope="col">Image</th>
                        <th class="alert" scope="col">buyer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $select_order = mysqli_query($conn, "SELECT order_details.* , 
                php1_asm_pk03114.order.* , products.* , 
                products.price as product_price ,order_details.quantity as order_details_quantity
                FROM `order_details`  
                INNER JOIN php1_asm_pk03114.order ON order_details.order_id = php1_asm_pk03114.order.order_id  
                INNER JOIN products ON order_details.product_id = products.product_id  
                 WHERE account_id = $account_id ")  or die("query failed");
                
                if (mysqli_num_rows($select_order) > 0) {
                while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                ?>

                    <tr>
                        <td><?php echo $fetch_order['name']; ?></td>
                        <td><?php echo $fetch_order['order_details_quantity']; ?></td>
                        <td> <?php echo $fetch_order['product_price']; ?>đ</td>
                        <td> <?php echo $fetch_order['address_ship']; ?></td>
                        <td><img height="100px" width="100px" src="images/<?php echo $fetch_order['image']; ?>"
                                alt="image not found">
                        </td>
                        <td><?php echo $fetch_order['created_by']; ?></td>



                    </tr>
                    <?php }
                }
                    ?>
                </tbody>
            </table>
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