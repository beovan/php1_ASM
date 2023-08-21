<?php
include '../config.php';
session_start();
include_once("../account_id.php");

if (isset($_GET['order_details_id']) && is_numeric($_GET['order_details_id'])) {
    $message = "";
    $categoryId = $_GET['order_details_id'];
    // Bước 3: Thực hiện câu truy vấn xoá bản ghi có ID tương ứng
    $sqlDelete = "DELETE FROM order_details WHERE order_details_id = $categoryId";
    if ($conn->query($sqlDelete) === TRUE) {
        $message = "Data deleted successfully.";
    } else {
        $message = "Error while deleting data:  " . $conn->error;
    }
} 

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>order</title>
    <?php
    include('./layout/header.php');
  ?>
</head>

<body>
<?php
   $select_user = mysqli_query($conn, "SELECT * FROM `account` 
   WHERE account_id ='$account_id' ") 
   or die("query failed");
   if (mysqli_num_rows($select_user) > 0) {
       $fetch_user = mysqli_fetch_assoc($select_user);
   };
   include("./layout/side_bar.php");
   ?>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="content">
            <!-- nav start -->
            <?php 
    include("./layout/spinner.php");
   include ("./layout/nav.php");
   
                 ?>
            <!-- nav close  -->

            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                <a href="./admin_user.php">return to admin </a>
                <br>
                <?php
            //chỉnh đây
            if (isset($message) && $message !== '') {
                echo $message;
            }
            //đến đây
            ?>
            <br>
                 <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Account ID</th>
                    <th>Total</th>
                    <th>Address Ship</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a database connection established ($conn)
                $query = "SELECT * FROM `order`"; // Replace with your actual table name
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['account_id']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['address_ship']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['created_by']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">No orders found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>

</body>

</html>