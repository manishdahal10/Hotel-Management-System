<?php
ob_start();

include 'dashboard.php';
@include 'connect.php';

$id = $_GET['edit'];

if(isset($_POST['update_room'])){

   $room_name = $_POST['room_name'];
   $room_price = $_POST['room_price'];
   $room_image = $_FILES['room_image']['name'];
   $room_image_tmp_name = $_FILES['room_image']['tmp_name'];
   $room_image_folder = 'uploaded_img/'.$room_image;

   if(empty($room_name) || empty($room_price) || empty($room_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE room_categories SET name='$room_name', price='$room_price', image='$room_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($room_image_tmp_name, $room_image_folder);
         header('location:room_category.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/roomcat.css">
  
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

    <section class="page">
   <div class="container">
   <div class="categories-section">
      <h3 style="color:green;">Room Category Form</h3>
     
      <div class="form-container">
      <?php
      
      $select = mysqli_query($conn, "SELECT * FROM room_categories WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
      <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="room_name">Update Category</label>
               <input type="text" id= "room_name" name="room_name"  value="<?php echo $row['name']; ?>" placeholder="Enter category" required>
            </div>
            <div class="form-group">
               <label for="price">Price</label>
               <input type="number" id="room_price" name="room_price" value="<?php echo $row['price']; ?>" placeholder="Enter price" required>
            </div>
            <div class="form-group">
               <label for="room_image">Image</label>
               <input id="room_image" type="file" accept="image/png, image/jpeg, image/jpg" value="<?php echo $row['image'] ?>" name="room_image"  required>
            </div>
            <div class="form-buttons">
            <input type="submit" value="Update" name="update_room" class="btn-update">
               <a href="room_category.php" class="btn-cancel" name="btnUpdate">Cancel</a>
            </div>
         </form>
     
         
      </div>
      <?php }; ?>
</section>
  <section class="page">
    <div class="container2">
      <div class="management-section">
      <!-- <h2>Room Categories</h2> -->
      <?php

$select = mysqli_query($conn, "SELECT * FROM room_categories");

?>
      <table>
         <thead>
            <tr>
            <th>Image</th>
            <th>Room</th>
            <th>Action</th>
         </tr>
               
         </thead>
         <tbody>
            <tr>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td class="">
										<p>Name : <b><?php echo $row['name'] ?></b></p>
										<p>Price : <b><?php echo "$".number_format($row['price'],2) ?></b></p>
				</td>
         
            <td>
               <a href="roomcategory_update.php?edit=<?php echo $row['id']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> Edit </a>
               <a href="room_category.php?delete=<?php echo $row['id']; ?>" class="btn-delete"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
      <?php } ?>
              
         </tbody>
      </table>
   </div>
 
</body>
</html>