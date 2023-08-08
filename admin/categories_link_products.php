<?php
 $sql_all_cate = "SELECT * FROM categories";
 $result_cate = $conn->query($sql_all_cate);
 $categories_link = [];
 while ($row = $result_cate->fetch_assoc()) {
     $categories_link[] = $row;
 }
?>