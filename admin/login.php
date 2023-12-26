<?php
session_start();
if (isset($_SESSION['username'])) {
  header("location: admin.php");
  exit();
  
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Replace with your database credentials
  $host = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'ho_tel';

  // Create a database connection
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL query
  $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    // Login successful, create session variable
    $_SESSION['username'] = $username;
    header("location: admin.php");
    exit();
  } else {
    // Invalid login credentials
    $error = "Invalid username or password.";
    header("location: index.php?error=" . urlencode($error));
    exit();
  }

  $conn->close();
}
?>
