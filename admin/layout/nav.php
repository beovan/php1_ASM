<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <div class="flex">
                <li class="nav-item">
                        <a  class="btn" aria-current="page" href="#"><span>Account: <?php echo $fetch_user['username']; ?> </span></a>
                    </li>
                    
                    <li class="nav-item">
                        <form class="flex" method="post">
                            <a  class="nav-link active" href="../Account_info.php?logout=<?php echo $account_id; ?>"
                                onclick="return confirm('Bạn đang muốn đăng xuất?');" >logout</a>
                        </form>
                    </li>
                </div>

            </ul>
        </div>
    </div>
</nav>