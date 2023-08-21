<?php
include '../config.php';
session_start();
include_once("../modules/account_id.php");

// Xử lý khi người dùng lưu thông tin chỉnh sửa
if (isset($_POST['submit'])) {
        $message = "";
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        if (empty($_POST['category_id']) || empty($selected_category_id = $_POST['category_id']) ) {
            // No category selected
            $message = "Please choose a category";
        }
        else {
        $selected_category_id = $_POST['category_id'];
        }
        // Kiểm tra xem người dùng đã chọn ảnh hay chưa
        if (empty($name) || trim($name) === '' || empty($price) || trim($price) === '' || empty($description) || trim($description) === '') {
            $message = "Please enter all the fields";

        } else {
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_path = "../images/" . $image;
               
                if (move_uploaded_file($image_tmp, $image_path)) {
                    
                    // Update the image path in the database
                    $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description', image = '$image', category_id = '$selected_category_id' WHERE product_id = '$product_id'";                    
                } else {
                    $message = "<span class='text text-danger'>Error uploading the image</span>";
                    

                }
            } else {
                if (empty($selected_category_id)) {
                    // No category selected
                    $message = "Please choose a category";
                }
                else {
                    $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description',category_id = '$selected_category_id' WHERE product_id = '$product_id'";
                    
                }
                // Nếu người dùng không chọn ảnh mới, chỉ thực hiện truy vấn UPDATE thông tin sản phẩm (không bao gồm ảnh)
               
            }
            if (isset($sql)) {
                
            if ($conn->query($sql)) {
                $message = "<span class='text text-success'>Product updated successfully</span>";
            } else {
                $message = "<span class='text text-danger'>Error updating product: " . $conn->error . "</span>";
            }
            }
        }
    }

// Lấy thông tin danh mục cần chỉnh sửa từ cơ sở dữ liệu
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
} 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit products</title>
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
          
                <a href="./products.php">return to products </a>
                <h2 class="mb-4">Change products information</h2>
                <form class="form-inline form" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo $product['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price"
                            value="<?php echo $product['price']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description"
                            name="description"><?php echo $product['description']; ?></textarea>
                    </div>
                    <?php
                    include("./categories_link_products.php");
                    ?>
                    <div class="form-group">
                        <label for="price">Category: </label>
                        <select  class="form-select" name="category_id">
                        <option selected disabled>Chose your category</option>
                            <?php foreach ($categories_link as $category) { ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input enctype="multipart/form-data" type="file" class="form-control" id="image" name="image"
                            value="<?php echo $product['image']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" name="submit">Save Changes</button>
                </form>
                <?php if (isset($message)) { echo $message; } ?>
                </div>
            </div>


            <!-- Footer Start -->
            <?php 
            include("./layout/footer.php");
            ?>
            <!-- Footer End -->

        </div>
    </div>

    <?php include("./file_js.php") ?>
</body>

</html>