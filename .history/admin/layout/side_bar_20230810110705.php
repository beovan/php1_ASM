   <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHBOARD</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $fetch_user['username'];?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../admin/admin_user.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a class= 'nav-item nav-link' href="../admin/users.php"><i class="bi bi-people-fill"></i>Users</a>
                    <a class= 'nav-item nav-link' href="../admin/categories.php">categories</a>
                    <a class= 'nav-item nav-link' href="../admin/products.php">products</a>
                    <a class= 'nav-item nav-link' href="../admin/order.php">Orders</a>
          
                </div>
            </nav>
        </div>