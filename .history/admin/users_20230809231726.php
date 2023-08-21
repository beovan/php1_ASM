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
 <!-- Spinner Start -->
 <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
           
                
                                <form class="form-inline form" action="" method="POST">
                                    <input type="text" class="form-control" name="username" placeholder="name ">
                                    <input type="email" class="form-control" name="email" placeholder="email ">
                                    <input type="text" class="form-control" name="password" placeholder="password ">
                                    <input type="text" class="form-control" name="cpassword"
                                        placeholder="confilm password ">

                                    <button type="submit" class="btn btn-primary mb-2" name="submit">save</button>
                                </form>
                            

                        
                                <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add users</h6>
                            <form  action="" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input  name="email" placeholder="email" type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input name="password" placeholder="password " type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confilm Password</label>
                                    <input name="cpassword"placeholder="confilm password " type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
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
<?php include("./file_js.php") ?>

</body>

</html>