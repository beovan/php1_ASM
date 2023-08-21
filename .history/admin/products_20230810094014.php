<?php
include '../config.php';
session_start();
include_once("../account_id.php");



// Lấy thông tin sản phẩm cần chỉnh sửa từ cơ sở dữ liệu
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $message = "";
    $product_id = $_GET['product_id'];
    // Bước 3: Thực hiện câu truy vấn xoá bản ghi có ID tương ứng
    $sqlDelete = "DELETE FROM products WHERE product_id = $product_id";
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
    <title>products</title>
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
                    <h6 class="mb-4">Add product</h6>
                    <form class="form-inline form" action="" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <?php
                                    include("./categories_link_products.php");
                                    ?>
                        <div class="mb-3">
                            <label for="price" class="form-label">Category: </label>
                            <select class="form-select" name="category_id">
                                <option selected disabled>Chose your category</option>
                                <?php foreach ($categories_link as $category) { ?>
                                <option value="<?php echo $category['category_id']; ?>">
                                    <?php echo $category['name']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="submit">Save
                            Changes</button>
                    </form>


                </div>
            </div>

            <form action="" method="POST" class="mb-3">
                <input class="col-form-label" type="text" name="search_keywords" placeholder="Enter keywords...">
                <button class="btn btn-primary" type="submit" name="search_button">Search</button>
            </form>
            <?php
            //chỉnh đây
            if (isset($_POST['submit'])) {
                $message = "";
                
                                            
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                //category id
                 
                if (empty($_POST['category_id']) || empty($selected_category_id = $_POST['category_id']) ) {
                    // No category selected
                    $message = "Please choose a category";
                }
                else {
                $selected_category_id = $_POST['category_id'];
                }
               
                    
               
                // ảnh 
                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_path = "../images/" . $image;
                    // var_dump(move_uploaded_file($image_tmp, $image_path));
                    if(move_uploaded_file($image_tmp, $image_path)){
                        echo "Tải tập tin thành công";
                    }else{
                        echo "Tải tập tin thất bại";
                    }

              
                // ảnh
                // var_dump($image_tmp);
                // var_dump($image_path );
                // var_dump($image);

                //  var_dump(move_uploaded_file($image_tmp, $image_path));
                if (empty($name) || trim($name) === '' || empty($price) || trim($price) === '' || empty($description) || trim($description) === '') {
                    $message = "Please enter all the fields";
                }
                else {
                $sql = "SELECT * FROM products WHERE name = '$name' ";
                $result = $conn->query($sql);
                $count = $result->num_rows;

                if ($count > 0) {
                    $message = "<span class='text text-danger'>product name already exists</span>";
                } else {
                  
                    $sql = "INSERT INTO products (name,price,description,image,category_id) VALUES ('$name','$price','$description','$image','$selected_category_id')";
                    if ($conn->query($sql) && $conn->query($sql_all_cate)) {
                        $message = "<span class='text text-success'>created successfully</span>";
                    }
                }
                }
                
            }
            
            if (isset($message) && $message !== '') {
                echo $message;
            }
            //search here
            if (isset($_POST['search_button']) && !empty($_POST['search_keywords']) && trim($_POST['search_keywords']) !== '') {
            
                // Get the search keywords entered by the user
                $search_keywords = mysqli_real_escape_string($conn, $_POST['search_keywords']);
                // Prepare the SQL query with multiple LIKE conditions to search across columns
                $sql_all = "SELECT products.*, categories.name AS category_name 
                        FROM products 
                        INNER JOIN categories ON products.category_id = categories.category_id
                        WHERE 
                        products.name LIKE '%$search_keywords%' OR 
                        description LIKE '%$search_keywords%'";
                
            
                // Execute the query
                $result = $conn->query($sql_all);
            
                // Check if any results are found
                if ($result->num_rows > 0) {
                    // Loop through the results and display them
                    while ($row = $result->fetch_assoc()) {
                        // Display product information here
                        $products = [];
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
                        // ... Display other product details as needed
                    }
                } else {

                    // No products found matching the search keywords
                    $sql_all = "SELECT products.*, categories.name AS category_name 
                    FROM products 
                    INNER JOIN categories ON products.category_id = categories.category_id";
                    $result = $conn->query($sql_all);
                    $products = [];
                    while ($row = $result->fetch_assoc()) {
                        $products[] = $row;
                    }
                }
            }
            //search end here
            else{
                $sql_all = "SELECT products.*, categories.name AS category_name 
                FROM products 
                INNER JOIN categories ON products.category_id = categories.category_id";
                $result = $conn->query($sql_all);
                $products = [];
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
            }
           
            //đến đây
            ?>
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">product list</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">category name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                <tr>
                                    <th scope="row"><?php echo $product['product_id']; ?></th>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td><?php echo $product['description']; ?></td>
                                    <td><?php echo $product['category_name']; ?></td>
                                    <td><img src="../images/<?php echo $product['image']; ?>" alt="Product Image"
                                            width="100">
                                    </td>

                                    <td>
                                        <a class="btn btn-primary"
                                            href="edit-products.php?product_id=<?php echo $product['product_id']; ?>">Edit</a>
                                        <a class="btn btn-danger"
                                            href="delete-product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Footer Start -->
            <?php 
            include("./layout/footer.php");
            ?>
            <!-- Footer End -->

        </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <?php include("./file_js.php") ?>

</body>

</html>