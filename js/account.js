class Account {
    constructor(userN, email, pass) {
        this.userName = userN;
        this.email = email;
        this.password = pass;
    }
}

function xuLyDangKy(event) {
    event.preventDefault();

    // Lấy thông tin người dùng nhập
    // Username
    let userName = document.getElementById('username');
    let value_username = userName.value;
    let errorUsername = document.getElementById("errousername");
    if (value_username.trim() === "" || value_username === null || value_username.length < 5) {
        alert("Chưa nhập tên đăng nhập");
        errorUsername.innerText = "Vui lòng kiểm tra lại Username";
        errorUsername.classList.add("erro-username");
        userName.classList.add("red-hight-light");
        userName.classList.remove("green-hight-light");
        userName.focus();
        errorUsername.classList.remove("display");
        return;
    } else {
        console.log(value_username);
        errorUsername.classList.remove("erro-username");
        errorUsername.classList.add("display");
        userName.classList.remove("red-hight-light");
        userName.classList.add("green-hight-light");
        userName.blur();
    }

    // Email
    let email = document.getElementById('email');
    let value_email = email.value;
    let erroremail = document.getElementById("erroemail");
    if (value_email.trim() === "" || value_email === null || !validateEmail(value_email)) {
        alert("Chưa nhập email hoặc email không hợp lệ");
        erroremail.innerText = "Vui lòng kiểm tra lại Email";
        erroremail.classList.add("erro-email");
        email.classList.add("red-hight-light");
        email.classList.remove("green-hight-light");
        email.focus();
        erroremail.classList.remove("display");
        return;
    } else {
        console.log(value_email);
        erroremail.classList.remove("erro-email");
        erroremail.classList.add("display");
        email.classList.remove("red-hight-light");
        email.classList.add("green-hight-light");
        email.blur();
    }

    // Password
    let password = document.getElementById('password');
    let value_password = password.value;
    let errorpass = document.getElementById("erro_password");
    if (value_password.trim() === "" || value_password === null || !validatePassword(value_password)) {
        alert("Chưa nhập mật khẩu hoặc mật khẩu không hợp lệ");
        errorpass.innerText = "Mật khẩu phải chứa ít nhất 8 kí tự, bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt";
        errorpass.classList.add("erro-password");
        password.classList.add("red-hight-light");
        password.classList.remove("green-hight-light");
        password.focus();
        errorpass.classList.remove("display");
        return;
    } else {
        console.log(value_password);
        errorpass.classList.remove("erro-password");
        errorpass.classList.add("display");
        password.classList.remove("red-hight-light");
        password.classList.add("green-hight-light");
        password.blur();
    }
    // Lưu thông tin tài khoản với key "user"
    
    let male = document.getElementById("male").value;
    let Female = document.getElementById("Female").value;
    localStorage.setItem("loggedInUser", value_username);
    localStorage.setItem("email_name", value_email);
    if (male) {
    localStorage.setItem("gender_name",male);
    }
    else if(Female){
    localStorage.setItem("gender_name",Female);
    }
    

    let dsTaiKhoan = JSON.parse(localStorage.getItem("user"));
    // Trường hợp key "user" chưa tồn tại, dsTaiKhoan = null
    if (!dsTaiKhoan) {
      
        // Tạo tài khoản mới
        let userMoi = new Account(value_username, value_email, value_password);
      
        dsTaiKhoan = [];
       
        // Lưu đối tượng vào mảng
        dsTaiKhoan.push(userMoi);
        // Lưu mảng dsTaiKhoan vào localStorage
        localStorage.setItem("user", JSON.stringify( { value: dsTaiKhoan }));
        //Lưu vào thông tin tài khoản 
      
        alert("Đăng ký tài khoản thành công");
        location.href = "login.html";
    }
    // Trường hợp đã tồn tại tài khoản
    else {
        //có value
        let dsTaiKhoan = JSON.parse(localStorage.getItem("user")).value;
        // Kiểm tra xem username có tồn tại chưa
        const found = dsTaiKhoan.find((user) => user.userName === value_username && user.password === value_password && user.email === value_email);
        // Trường hợp đã tồn tại
        if (found) {
            alert("Tài khoản đã tồn tại");
            return;
        }
        // Trường hợp không trùng, tạo tài khoản mới
        let userMoi = new Account(value_username, value_email, value_password);
        // Lưu thêm vào mảng
        dsTaiKhoan.push(userMoi);
        // Lưu mảng mới cập nhật vào lại localStorage
        localStorage.setItem("user", JSON.stringify({ value: dsTaiKhoan }));
        alert("Đăng ký tài khoản thành công");
    }
}

//Đăng nhập
function xuLyDangNhap(event){
    event.preventDefault();
    let userName = document.getElementById('username').value;
    let pass = document.getElementById('password').value;

    //validate
    if(userName.trim() ==="" || pass.trim()===""){
        alert("Chưa nhập username/mật khẩu")
        return;
    }
    

    //Đối chiếu với các tài khoản đăng lưu trong localStorage
    const dsTaiKhoan = JSON.parse(localStorage.getItem("user")).value ;
    if(dsTaiKhoan){
        const found = dsTaiKhoan.find((user) => user.userName === userName && user.password === pass);
        if(found){
            alert("Đăng nhập thành công");
            //
            localStorage.setItem("loggedInUser", userName);
            var checkBox = document.getElementById("check_password");
            if (checkBox.checked == true){
             localStorage.setItem("passWord",pass);
             console.log("đã lưu rồi:");
            } else {
             console.log("Bạn đã bỏ tích và chưa lưu ");
            }
            //
            location.href = "index.html";
           
        }
        else{
            alert("Tài khoản không tồn tại")
        }
    }
}
//checkbox

// Hàm kiểm tra định dạng email
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Hàm kiểm tra định dạng password
function validatePassword(password) {
    // Mật khẩu phải chứa ít nhất 8 kí tự, bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password);
}
//Lưu mật khẩu 
// const checked = document.querySelector('#accept:checked') !== null;
// console.log(checked); // false

 // Kiểm tra người dùng đã đăng nhập hay chưa
 function checkLoggedInUser() {
    const loggedInUser = localStorage.getItem("loggedInUser");
    // const restorage_pass = localStorage.getItem("passWord");
    let name_info = document.getElementById("name_info");
    let email_Info = document.getElementById("email_Info");
    let gender_info = document.getElementById("gender_info");
    //
    const gender_name = localStorage.getItem("gender_name");
    const email_name = localStorage.getItem("email_name");
    const menuUsername = document.getElementById("menuUsername");
    const loginButton = document.getElementById("loginBtn");
    const RegisterButton = document.getElementById("registerBtn");
    const logoutButton = document.getElementById("logoutButton");
    const account_info = document.getElementById("account_info");

    
    

    if (loggedInUser) {
      // Hiển thị tên người dùng và nút đăng xuất
      
      menuUsername.textContent = loggedInUser;
      if (name_info) {
        name_info.innerText = loggedInUser;
      } 
      if (email_Info) {
        email_Info.innerText = email_name;
      }
      if(gender_info) {
        gender_info.innerText = gender_name;
      }
      loginButton.style.display = "none";
      logoutButton.style.display = "block";
      account_info.style.display = "block";
      RegisterButton.style.display = "none";

    } else {
      // Hiển thị nút đăng nhập
      menuUsername.textContent = "Account";
      loginButton.style.display = "block";
      logoutButton.style.display = "none";
      account_info.style.display = "none";
      RegisterButton.style.display = "block";
    }
  }

  // Đăng xuất
  function logout() {
    localStorage.removeItem("loggedInUser");
    window.location.href = "login.html"; // Chuyển hướng đến trang đăng nhập
  }




//Geolocaion
// Check if geolocation is supported
function hienThi() {
    if (navigator.geolocation) {
        // Request permission to access user's location
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
      } else {
        console.log("Geolocation is not supported.");
      }
      
      function successCallback(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
      
        console.log("Latitude: " + latitude);
        console.log("Longitude: " + longitude);
      
        // Display the location on a map
        const mapDiv = document.getElementById("map");
        mapDiv.src = `https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3892.056195570977!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTLCsDQyJzM1LjEiTiAxMDjCsDA0JzI5LjgiRQ!5e0!3m2!1sen!2sus!4v1685766211010!5m2!1sen!2sus`;
      }
      
      function errorCallback(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            console.log("User denied the request for geolocation.");
            break;
          case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.");
            break;
          case error.TIMEOUT:
            console.log("The request to get user location timed out.");
            break;
          case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.");
            break;
        }
      }
      
}

