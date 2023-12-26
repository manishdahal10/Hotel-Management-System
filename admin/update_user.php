<?php
ob_start();
include "dashboard.php";
include "connect.php";

$id = $_GET['user_id'];

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
  

    $conn = new mysqli('localhost', 'root', '', 'ho_tel');
    $sql = "update users set name='$name',phone='$phone',address='$address',email='$email',username='$username', gender='$gender' where user_id=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: users.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Update User Form</title>
  <style>
    .container {
      max-width: 500px;
      margin-left: 550px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
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
      margin-top: 110px;
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
<?php
    $sql = "SELECT * FROM `users` WHERE user_id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
  <div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?user_id=<?php echo $id ?>" method="post" class="user">
      <h2>Update User</h2><br>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>">
        <?php echo (isset($err['name']) ? $err['name'] : ''); ?>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username'] ?>">
        <?php echo (isset($err['username']) ? $err['username'] : ''); ?>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row['phone'] ?>">
        <?php echo (isset($err['phone']) ? $err['phone'] : ''); ?>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="<?php echo $row['address'] ?>">
        <?php echo (isset($err['address']) ? $err['address'] : ''); ?>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
        <?php echo (isset($err['email']) ? $err['email'] : ''); ?>
      </div>
      <div class="gender-group">
        <label for="gender">Gender</label><br>
        <input type="radio"  name="gender"  id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
  <label for="male">Male</label>
  <span><input type="radio" id="female" name="gender" value="female" <?php echo ($row["gender"] == 'female') ? 'checked' : ''; ?>>
  <label for="female">Female</label>
  <input type="radio" id="other" name="gender" value="other" <?php echo ($row["gender"] == 'other') ? 'checked' : ''; ?>>
  <label for="other">Other</label>
      </div>
     

      <div class="btn-container">
      <button type="submit" name="submit">Update</button>
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
