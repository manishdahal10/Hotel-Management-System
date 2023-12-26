<?php
ob_start();
include "dashboard.php";



if (isset($_POST["submit"])) {
   $name = $_POST['name'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $password = $_POST['password'];
   $gender = $_POST['gender'];
   include "connect.php";
// $conn = new mysqli('localhost','root','','ho_tel');
   $sql = "insert into users (name,username,email,phone,address,password,gender) values('$name','$username','$email','$phone','$address','$password','$gender')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: users.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

?>
 
  

<!DOCTYPE html>
<html>
  <head>
    <title>New User Form</title>
    <style>
        .container {
          max-width: 600px;
          margin-left: 550px;
          padding: 20px;
          background-color: #fff;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 30px;
            color: #4caf50;
          text-align: center;
        }

        .form-group {
          margin-bottom: 20px;
        }

        label {
          display: block;
          font-weight: bold;
          margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
          width: 100%;
          padding: 10px;
          font-size: 16px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        select {
          height: 40px;
        }

        .btn-container {
          text-align: center;
        }

        button {
          padding: 10px 20px;
          font-size: 16px;
          background-color: #4caf50;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }

        button:hover {
          opacity: 0.8;
        }

        .user {
          margin-top: 60px;
        }

        .gender-group {
        margin-bottom: 20px;
      }

      .gender-group label {
        display: inline-block;
        font-weight: bold;
        margin-bottom: 5px;
        
        
        }


      .gender-group input[type="radio"] {
        margin-right: 10px;
      }

      .gender-group input[type="radio"] + label {
        margin-right: 20px;
      }

      .btn-update {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
      }

      .btn-update:hover {
        opacity: 0.8;
      }


    </style>
  </head>
<body>

  <div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="user">
      <h2>New User</h2><br>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name"  placeholder="Enter name" />
           
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text"  id="username" name="username" placeholder="Enter username" />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter your password"  />
      
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" placeholder="Enter your number" name="phone" />
          
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text"  id="address" name="address" placeholder="Enter Address" />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Enter your email" name="email"  />
            
      </div>
      
      <div class="gender-group">
        <label for="gender">Gender</label><br>
        <input type="radio"  name="gender"  id="male" value="male" >
  <label for="male">Male</label>
  <span><input type="radio" id="female" name="gender" value="female" >
  <label for="female">Female</label>
  <input type="radio" id="other" name="gender" value="other" >
  <label for="other">Other</label>
  
      </div>
     

      <div class="btn-container">
      <button type="submit" name="submit">Submit</button>
      <!-- <a href="user.php" class="btn-update" name="submit" type="submit">Update</a> -->
      <!-- <button <a href="index.php" >Cancel</a> </button>
          <a href="index.php" >Cancel</a> -->
  <a href="users.php" class="btn-update" name="btnUpdate">Cancel</a>
   </div>
    </div>
    </form>
  </div>
</body>
</html>
