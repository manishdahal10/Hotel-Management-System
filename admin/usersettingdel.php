<?php 
$id = $_GET['user_id'];
try{
  $conn = new mysqli('localhost','root','','ho_tel');
  // $sql = "insert into tbl_users (name,email,username,password,role) values('Hari Bahadur','hari.bahadur@gmail.com','harry','harry123','user')";
  $sql = "delete from users where user_id=$id";
  $conn->query($sql);
  if ($conn->affected_rows == 1 ) {
    echo "User delete success";
  }
  header("Location: users.php?msg=Deleted successfully");
}
catch(Exception $e){
   die('Database  Error : ' .$e->getMessage());
}
 ?>

