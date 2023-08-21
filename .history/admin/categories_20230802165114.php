<?php
include '../config.php';
session_start();
include_once("../account_id.php");

if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $message = "";
    $categoryId = $_GET['category_id'];
    // Bước 3: Thực hiện câu truy vấn xoá bản ghi có ID tương ứng
    $sqlDelete = "DELETE FROM categories WHERE category_id = $categoryId";
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
    <title>categories</title>
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
            <a href="./admin_user.php">return to admin </a>
                <form class="form-inline form" action="" method="POST">
                    <input type="text" class="form-control" name="name" placeholder="input name category">
                    <button type="submit" class="btn btn-primary mb-2" name="submit">save</button>
                </form>
                <?php
            //chỉnh đây
            if (isset($_POST['submit'])) {
                $message = "";
                $name = $_POST['name'];
                if (empty($name) || trim($name) === '') {
                $message = "Please enter a name";
                }
                else {
                $sql = "SELECT * FROM categories WHERE name = '$name'";
                $result = $conn->query($sql);
                $count = $result->num_rows;

                if ($count > 0) {
                    $message = "<span class='text text-danger'>category name already exists</span>";
                } else {
                    $sql = "INSERT INTO categories (name) VALUES ('$name')";
                    if ($conn->query($sql)) {
                        $message = "<span class='text text-success'>created successfully</span>";
                    }
                }
                }
                
            }
            
            if (isset($message) && $message !== '') {
                echo $message;
            }

            $sql_all = "SELECT * FROM categories";
            $result = $conn->query($sql_all);
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            //đến đây
            ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- xuất ra thông tin  -->
                        <?php foreach ($categories as $category) { ?>
                        <tr>
                            <th scope="row"><?php echo $category['category_id']; ?></th>
                            <td><?php echo $category['name']; ?></td>
                            <td>
                                <!-- Nút Edit -->
                                <a class="btn btn-primary"
                                    href="edit-category.php?category_id=<?php echo $category['category_id']; ?>">Edit</a>
                                <a class="btn btn-danger"
                                    href="categories.php?category_id=<?php echo $category['category_id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>