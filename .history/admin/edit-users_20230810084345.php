<?php
include '../config.php';
session_start();
include_once("../account_id.php");

// Xử lý khi người dùng lưu thông tin chỉnh sửa
if (isset($_POST['submit'])) {
    $message = "";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    if (empty($username) || trim($username) === '' ||   trim($email) === '' ){
    $message = "Please enter a username and email address";
    }
    if (trim($pass) === '' || trim($cpass) === '') {
        $message = "Please enter passwords";
    }
    else {
        $account_id = $_POST['account_id'];

    $sql = "UPDATE account SET username = '$username' , email = '$email', password = '$pass' WHERE account_id = '$account_id'";
    if ($conn->query($sql)) {
        $message = "<span class='text text-success'>Updated successfully</span>";
    } else {
        $message = "<span class='text text-danger'>Error updating record: " . $conn->error . "</span>";
    }
    }
    
}

// Lấy thông tin danh mục cần chỉnh sửa từ cơ sở dữ liệu
if (isset($_GET['account_id']) && is_numeric($_GET['account_id'])) {
    $account_id = $_GET['account_id'];
    $sql = "SELECT * FROM account WHERE account_id = '$account_id'";
    $result = $conn->query($sql);
    $users = $result->fetch_assoc();
    
} 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit users</title>
    <?php
    include('./layout/header.php');
  ?>
</head>

<body>
    <div class="container">
    
        <div class="row">
        <?php
   $select_user = mysqli_query($conn, "SELECT * FROM `account` 
   WHERE account_id ='$account_id' ") 
   or die("query failed");
   if (mysqli_num_rows($select_user) > 0) {
       $fetch_user = mysqli_fetch_assoc($select_user);
   };
   include "./layout/nav.php";
   include("./layout/side_bar.php");
   ?>
            <div class="col col-lg-10">
                <a href="./users.php">return to users </a>
                <h2>Change users information</h2>
                <form class="form-inline form" action="" method="POST">
                    <input type="hidden" name="account_id" value="<?php echo $users['account_id']; ?>">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $users['username']; ?>">
                    <label for="email">email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $users['email']; ?>">
                    <label for="password">password</label>
                    <input type="text" class="form-control" name="password" value="">
                    <label for="confilm password">confilm password</label>
                    <input type="text" class="form-control" name="cpassword" value="">
                    <button type="submit" class="btn btn-primary mb-2" name="submit">Save Changes</button>
                </form>
                <?php if (isset($message)) { echo $message; } ?>
            </div>
        </div>
    </div>
</body>

</html>
