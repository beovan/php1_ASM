<?php
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $product_id = $_POST['product_id'];

    $select_cart = mysqli_query($conn, "SELECT * FROM  `cart` 
    WHERE name = '$product_name'
    AND account_id='$account_id' ") or die("query failed");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    }
    else {
        if (isset($_SESSION['account_id'])) {
            // If the 'account_id' key exists, assign it to the $account_id variable
            $account_id = $_SESSION['account_id'];
            mysqli_query($conn, "INSERT INTO `cart`(account_id,name,price,image,quantity,product_id)
            VALUES('$account_id','$product_name','$product_price','$product_image','$product_quantity','$product_id' )" ) 
            or die("query failed");
            $message[] = 'product added to cart';
            
        }
        else {
            $account_id = $_SESSION['account_id'];
            mysqli_query($conn, "INSERT INTO `cart`(account_id,name,price,image,quantity,product_id)
            VALUES(0,'$product_name','$product_price','$product_image','$product_quantity','$product_id' )" ) 
            or die("query failed");
            $message[] = 'product added to cart';
        }
       
       
    }

}
?>