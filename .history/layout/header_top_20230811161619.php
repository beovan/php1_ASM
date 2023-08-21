<div class="header-top">
      <div class="row-header-top">
        <div class="contact-info ">
          <ul>
            <li><a class="disabled" href="#">+880 4664 216</a></li>
            <li><a class="disabled" href="#">Mon - Sat 10:00 - 7:00</a></li>
          </ul>
        </div>

        <div class="social-icon">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-pinterest"></i></a>
          <a href="#"><i class="bi bi-google"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
        </div>

        <div class="dropdown">
        <button id="menuUsername" class="dropbtn"><?php 
          if (isset($_SESSION['account_id'])) {
            include("./modules/excute_account_info.php");
            echo $fetch_user['username'];
          }
          else {
            echo "Account";
          }
          
          ?></button>
       <div class="dropdown-content">
            <a style="<?php foreach($display_none as $value) {echo $value;};?>" href="login.php" id="loginBtn">Login</a>
            <a style="<?php foreach($display_none_logout as $value) {echo $value;};?>" href="Account_info.php" id="account_info"  >account info</a>
            <a id="logoutButton" onclick="logout()" style="display: none;">logout</a>
            <a style="<?php foreach($display_none as $value) {echo $value;};?>" href="register.php" id="registerBtn">register</a>
            
          </div>
        </div>
        
      </div>
      
     
    </div>