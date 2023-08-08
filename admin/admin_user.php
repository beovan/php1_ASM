<?php
  include '../config.php';
  session_start();
  include_once("../account_id.php");

 ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>dashboard</title>
  <?php
    include('./layout/header.php');
  ?>

</head>

<body >
  
 
   <?php

if (isset($message)) {
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}
?>
    <div class="container">
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
                        

    </div>
</body>

</html>