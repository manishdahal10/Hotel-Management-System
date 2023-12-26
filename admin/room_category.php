<?php
ob_start();
include 'dashboard.php';
@include 'connect.php';




if(isset($_POST['add_room'])){

   $room_name = $_POST['room_name'];
   $room_price = $_POST['room_price'];
   $room_image = $_FILES['room_image']['name'];
   $room_image_tmp_name = $_FILES['room_image']['tmp_name'];
   $room_image_folder = 'uploaded_img/'.$room_image;

   if(empty($room_name) || empty($room_price) || empty($room_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO room_categories(name, price, image) VALUES('$room_name', '$room_price', '$room_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($room_image_tmp_name, $room_image_folder);
         $message[] = 'new room added successfully';
      }else{
         $message[] = 'could not add the room';
      }
   }

};


if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM room_categories WHERE id = $id");
   header('location:room_category.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Room Category Management</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/roomcat.css">
</head>
<body>
    <section class="page">
   <div class="container">
   <div class="categories-section">
      <h3 style="color:green;">Room Category Form</h3>
     
      <div class="form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="room_name">Add New Category</label>
               <input type="text" id= "room_name" name="room_name" placeholder="Enter category name" required>
            </div>
            <div class="form-group">
               <label for="price">Price</label>
               <input type="number" id="room_price" name="room_price" placeholder="Enter price" required>
            </div>
            <div class="form-group">
               <label for="room_image">Image</label>
               <input  id="room_image" type="file" accept="image/png, image/jpeg, image/jpg" name="room_image"  required>
            </div>
            <div class="form-buttons">
               <input type="submit" value="Save" class="btn-update" name="add_room" class="btn-save">
               <button type="button" class="btn-cancel" onclick="cancelForm()">Cancel</button>
               
            </div>
         </form>
         
      </div>
      <?php

   $select = mysqli_query($conn, "SELECT * FROM room_categories");
   
   ?>
</section>
  <section class="page">
    <div class="container2">
      <div class="management-section">
      
      <table >
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
   <script>
      function cancelForm() {
  // Clear form inputs and reset file input
  document.getElementById("room_name").value = "";
  document.getElementById("room_price").value = "";
  document.getElementById("room_image").value = "";
}
</script>
</body>
</html>
