<?php

$account_id = $_SESSION['account_id'];

if (!isset($account_id)){
    header('location:login.php');
}

//logout thì quay lại trang chủ
if (isset($_GET['logout'])) {
    unset($account_id);
    session_destroy();
    header('location:login.php');
    exit;
}

?>