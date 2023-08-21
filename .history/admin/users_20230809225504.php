<?php
include '../config.php';
session_start();
include_once("../account_id.php");

if (isset($_GET['account_id']) && is_numeric($_GET['account_id'])) {
    $message = "";
    $account_id = $_GET['account_id'];
    // Bước 3: Thực hiện câu truy vấn xoá bản ghi có ID tương ứng
    $sqlDelete = "DELETE FROM account WHERE account_id = $account_id";
    if ($conn->query($sqlDelete) === TRUE) {
        $message = "Data deleted successfully.";
    } else {
        $message = "Error while deleting data:  " . $conn->error;
    }
} else {
    $message = "Invalid ID";
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
    <?php
    include('./layout/header.php');
  ?>

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
        <div class="container-xxl position-relative bg-white d-flex p-0">
  <div class="content">

           
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Add Users
                </button>
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
                                <form class="form-inline form" action="" method="POST">
                                    <input type="text" class="form-control" name="username" placeholder="name ">
                                    <input type="email" class="form-control" name="email" placeholder="email ">
                                    <input type="text" class="form-control" name="password" placeholder="password ">
                                    <input type="text" class="form-control" name="cpassword"
                                        placeholder="confilm password ">

                                    <button type="submit" class="btn btn-primary mb-2" name="submit">save</button>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <?php
            //chỉnh đây
            if (isset($_POST['submit'])) {
                $message = "";
                 
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
                if (empty($username) || trim($username) === ''  ) {
                $message = "<span class='text text-danger'>
                Please enter a username
                            </span>";
                }
                elseif ( trim($email) === ''|| empty($email)) {
                    $message = "<span class='text text-danger'>
                    Please enter email address
                                </span>";
                }
                 elseif (empty($password) || trim($password) === '') {
                    $message = "<span class='text text-danger'>
                    Please enter a password
                                </span>";
                } elseif (empty($cpassword) || trim($cpassword) === '') {
                    $message = "<span class='text text-danger'>
                    Please enter the password again for confirmation
                                </span>";
                } elseif ($password !== $cpassword) {
                $message = "<span class='text text-danger'>
                Passwords do not match
                            </span>";
                }
                else {
                $sql = "SELECT * FROM account WHERE username = '$username' AND email = '$email'";
                $result = $conn->query($sql);
                $count = $result->num_rows;

                if ($count > 0) {
                    $message = "<span class='text text-danger'> username already exists</span>";
                } else {
                    $sql = "INSERT INTO account (username,email,password)VALUES ('$username','$email','$password') ";
                    if ($conn->query($sql)) {
                        $message = "<span class='text text-success'>created successfully</span>";
                        $_POST['password'] = "";
                        $_POST['cpassword'] = "";
                    }
                }
                }
                
            }
            
            if (isset($message) && $message !== '') {
                echo $message;
            }

            $sql_all = "SELECT * FROM account WHERE role = '1' ";
            $result = $conn->query($sql_all);
            $account = [];
            while ($row = $result->fetch_assoc()) {
                $account[] = $row;
            }
            //đến đây
            ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">username</th>
                            <th scope="col">email</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- xuất ra thông tin  -->
                        <?php foreach ($account as $users) { ?>
                        <tr>
                            <th scope="row"><?php echo $users['account_id']; ?></th>
                            <td><?php echo $users['username']; ?></td>
                            <td><?php echo $users['email']; ?></td>
                            <td>
                                <!-- Nút Edit -->
                                <a class="btn btn-primary"
                                    href="edit-users.php?account_id=<?php echo $users['account_id']; ?>">Edit</a>
                                <a class="btn btn-danger"
                                    href="users.php?account_id=<?php echo $users['account_id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>