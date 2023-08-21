<?php
include '../config.php';
session_start();
include_once("../account_id.php");

// Xử lý khi người dùng lưu thông tin chỉnh sửa
if (isset($_POST['submit'])) {
    $message = "";
    $name = $_POST['name'];
    if (empty($name) || trim($name) === '') {
    $message = "Please enter a name";
    }
    else {
        $categoryId = $_POST['category_id'];

    $sql = "UPDATE categories SET name = '$name' WHERE category_id = '$categoryId'";
    if ($conn->query($sql)) {
        $message = "<span class='text text-success'>Updated successfully</span>";
    } else {
        $message = "<span class='text text-danger'>Error updating record: " . $conn->error . "</span>";
    }
    }
    
}

// Lấy thông tin danh mục cần chỉnh sửa từ cơ sở dữ liệu
if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id = '$categoryId'";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
} else {
    // Nếu không có category_id hợp lệ, điều hướng người dùng về trang categories.php hoặc thông báo lỗi
    header("Location: categories.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Category</title>
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
                <a href="./categories.php">return to categories </a>
                <h2>Change the name category</h2>
                <form class="form-inline form" action="" method="POST">
                    <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                    <input type="text" class="form-control" name="name" value="<?php echo $category['name']; ?>">
                    <button type="submit" class="btn btn-primary mb-2" name="submit">Save Changes</button>
                </form>
                <?php if (isset($message)) { echo $message; } ?>
            </div>
        </div>
    </div>
</body>

</html>
