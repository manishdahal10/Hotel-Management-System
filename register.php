<?php 
ob_start();
include "topnav.php";

$name = $username = $email = $phone = $address = $password = $gender = '';
if (isset($_POST['btnRegister'])) {
  $err = [];
  if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
    $name = $_POST['name'];
  } else {
    $err['name'] = "Enter name";
  }

  if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
    $username = $_POST['username'];
  } else {
    $err['username'] = "Enter username";
  }

  if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
    $phone = $_POST['phone'];
  } else {
    $err['phone'] = "Enter phone";
  }

  if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err['email'] = "Invalid email format";
    }
  } else {
    $err['email'] = "Enter email";
  }
  if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
    $address= $_POST['address'];
  } else {
    $err['address'] = "Enter Address";
  }


  if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = md5($_POST['password']);
  } else {
    $err['password'] = "Enter password";
  }

  // if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
  //   $confirm_password = md5($_POST['confirm_password']);
  //   if ($password !== $confirm_password) {
  //     $err['confirm_password'] = "Passwords do not match";
  //   }
  // } else {
  //   $err['confirm_password'] = "Confirm password";
  // }

  if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
    $gender = $_POST['gender'];
  } else {
    $err['gender'] = "Enter gender";
  }

  if (count($err) == 0) {
    try {
      $conn = new mysqli('localhost', 'root', '', 'ho_tel');
      // $sql = "insert into tbl_users (name,email,username,password,role) values('Hari Bahadur','hari.bahadur@gmail.com','harry','harry123','user')";
      $sql = "insert into users (name,username,email,phone,address,password,gender) values('$name','$username','$email','$phone','$address','$password','$gender')";
      $conn->query($sql);
      if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
        header('location:login.php');
        echo "User created success";
      }
    } catch (Exception $e) {
      die('Database  Error : ' . $e->getMessage());
    }
  }
}
?>
<style>
 .container{
  position: relative;
  margin-left: 280px;
  margin-top: 50px;
  max-width: 700px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
   }
 .container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
   }
   .container .details{
    font-size: 16px;
    font-weight: 500;
   }
  .container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background:var(--primary);;
  }
   .content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
  }
  form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
    }
   form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
   }
   .user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
  }
  .user-details .input-box input:focus,
  .user-details .input-box input:valid{
  border-color: #9b59b6;
   }
 form .gender-details .gender-title{
  font-size: 18px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category .gender{
    font-size: 16px;
    font-weight: 500;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
  }
 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: var(--primary);;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0;
   
 }
  form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: var(--primary);;
  }
 form .button input:hover{
  transform: scale(0.99);
  background: #5b13b9;
  }
 
</style>

<section class="register">
  <div class="container">
    
    <div class="title">Registration</div>
    <div class="content">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter name" />
            <?php echo (isset($err['name']) ? $err['name'] : ''); ?>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" id="username" placeholder="Enter username" value="<?php echo $username; ?>" />
    <span id="availability"></span>
    <?php echo (isset($err['username'])?$err['username']:''); ?>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" id="email" value="<?php echo $email; ?>" />
            <span id="emailAvailability" class="availability"></span>
            <?php echo (isset($err['email']) ? $err['email'] : ''); ?>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" value="<?php echo $phone;?>"/>
            <?php echo (isset($err['phone']) ? $err['phone'] : ''); ?>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Enter Address" />
            <?php echo (isset($err['address']) ? $err['address'] : ''); ?>
          </div>
<div class="input-box">
  <span class="details">Password</span>
  <input type="password" name="password" placeholder="Enter your password" />
  <?php echo (isset($err['password']) ? $err['password'] : ''); ?>
</div>
<!-- <div class="input-box">
  <span class="details">Confirm Password</span>
  <input type="password" name="confirm_password" placeholder="Confirm your password" />
  <?php echo (isset($err['confirm_password']) ? $err['confirm_password'] : ''); ?>
  </div> -->
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="Male" id="dot-1">
          <input type="radio" name="gender" value="Female"  id="dot-2">
          <input type="radio" name="gender" value="Other"  id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
            <?php echo (isset($err['gender']) ? $err['gender'] : ''); ?>
          </div>
        </div>
        <div class="button">
        <input type="submit" id="register" name="btnRegister" value="Register" />
        
        </div>
      </form>
    </div>
  </div>
</section>
<script>
  // Function to check the availability of username
  function checkUsernameAvailability() {
    const username = document.getElementById('username').value;

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Prepare the AJAX request
    xhr.open('POST', 'check_username_availability.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Set up the callback function
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        const availabilitySpan = document.getElementById('availability');

        if (response.available) {
          availabilitySpan.textContent = 'Username available';
          availabilitySpan.style.color = 'green';
        } else {
          availabilitySpan.textContent = 'Username not available';
          availabilitySpan.style.color = 'red';
        }
      }
    };

    // Send the request with the username data
    xhr.send('username=' + username);
  }

  // Attach an event listener to the username input field
  document.getElementById('username').addEventListener('keyup', checkUsernameAvailability);
</script>


<script>
  // Function to check the availability of email
  function checkEmailAvailability() {
    const email = document.getElementById('email').value;

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Prepare the AJAX request
    xhr.open('POST', 'check_email_availability.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Set up the callback function
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        const emailAvailabilitySpan = document.getElementById('emailAvailability');

        if (response.available) {
          emailAvailabilitySpan.textContent = 'Email available';
          emailAvailabilitySpan.style.color = 'green';
        } else {
          emailAvailabilitySpan.textContent = 'Email not available';
          emailAvailabilitySpan.style.color = 'red';
        }
      }
    };

    // Send the request with the email data
    xhr.send('email=' + email);
  }

  // Attach an event listener to the email input field
  document.getElementById('email').addEventListener('keyup', checkEmailAvailability);
</script>



</body>
</html>