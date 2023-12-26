<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    
    .container {
      display: flex;
      align-items: center;
      width: 800px;
      height: 500px;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .image-container {
      flex: 1;
    }

    .image-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      margin-left:8px;
    }

    .form-container {
      flex: 1;
      padding: 20px;
      background-color: #fff;
      margin-right:8px;
      margin-left:8px;
    }

    .form-container h2 {
      margin-bottom: 30px;
      color: green;
      text-align: center;
    }

    .form-container label,
    .form-container input {
      display: block;
      margin-bottom: 10px;
    }

    .form-container input[type="text"],
    .form-container input[type="password"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      transition: border-color 0.3s ease-in-out;
    }

    .form-container input[type="text"]:hover,
    .form-container input[type="password"]:hover {
      border-color: #999;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="password"]:focus {
      border-color: #007bff;
    }

    
    .form-container .submit{
    width: 100%;
      padding: 8px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      margin-bottom:15px;
    }

    .form-container .submit:hover {
      background-color: #45a049;
    }
    .error {
  color: red;
  font-size: 14px;
  margin-top: 10px;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="image-container">
      <img src="images/adminlogo.png" alt="Photo">
    </div>
    <div class="form-container">
      <h2>Admin Login</h2>
      <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"  required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  required>
        <!-- <button type="submit" name="login">Login</button> -->
        <center><button class="submit" name="login" >Login</button></center>
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      </form>
    </div>
  </div>
 
</body>
</html>
