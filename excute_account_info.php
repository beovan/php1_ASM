<?php
 $select_user = mysqli_query($conn, "SELECT * FROM `account` 
 WHERE account_id ='$account_id' ") 
 or die("query failed");
 if (mysqli_num_rows($select_user) > 0) {
     $fetch_user = mysqli_fetch_assoc($select_user);
 }
 else {
    $message[] = "";
 }
 ;
?>