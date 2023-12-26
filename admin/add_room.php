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
   $area = $_POST['area'];
   $quantity = $_POST['quantity'];
   $adult = $_POST['adult'];
   $children = $_POST['children'];
   $features = implode(',', $_POST['features']);
   $facilities = implode(',', $_POST['facilities']);
   $desc = $_POST['desc'];

   if(empty($room_name) || empty($room_price) || empty($room_image) || empty($area) || empty($quantity) || empty($adult) || empty($children) || empty($features) || empty($facilities) || empty($desc)){
      $message[] = 'Please fill out all fields';
   }else{
      $insert = "INSERT INTO `room_categories`( `name`, `price`, `image`, `area`, `quantity`, `adult`, `children`, `desc`, `facilities`, `features`) VALUES 
      ('$room_name','$room_price','$room_image','$area','$quantity','$adult','$children','$desc','$facilities','$features')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($room_image_tmp_name, $room_image_folder);
         $message[] = 'New room added successfully';
         header("location:display_room.php");
      }else{
         $message[] = 'Could not add the room';
      }
   }
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

<style>
                    .container {
                margin-left: 25%;
                max-width: 70%;
                width: 100%;
                background-color: #fff;
                padding: 25px 30px;
                border-radius: 5px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
                }

                .container .form-group {
                font-size: 16px;
                font-weight: 500;
                }

                .container .form-container {
                margin-top: 90px;
                }

                .container .form-container h3 {
                    margin-bottom:6px;
                font-weight: 600;
                font-size: 30px;
                color: green;
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
                input[type="number"],
                input[type="file"],
                textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                }

                .checkbox-group {
                /* display: flex;
                flex-wrap: wrap; */
                }

                .checkbox-group input[type="checkbox"],
                .checkbox-group label {
                display: inline-block;
                margin-bottom: 5px;
                flex: 1 0 50%;
                margin-bottom: 5px;
                }

                .form-buttons {
                display: flex;
                justify-content: flex-end;
                margin-top: 20px;
                }

                .btn-update {
                display: inline-block;
                padding: 8px 15px;
                font-size: 15px;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                text-decoration: none;
                margin: 2px;
                }

                .btn-update:hover {
                opacity: 0.8;
                }

                .btn-cancel {
                background-color: #ccc;
                text-decoration: none;
                color: #000;
                }

                .btn-save:hover,
                .btn-cancel:hover {
                background-color: #45a049;
                }

                .form-group img {
                max-width: 200px;
                display: none;
                margin-top: 10px;
                }



  

      .checkbox-group input[type="checkbox"],
      .checkbox-group label {
        display: inline-block;
      
        margin-bottom: 5px;
         flex: 1 0 50%;
         margin-bottom: 5px;
      }

      .form-buttons {
         display: flex;
         justify-content: flex-end;
         margin-top: 20px;
      }

      .btn-update   {
         display: inline-block;
         padding: 8px 15px;
         font-size: 15px;
         background-color: #4caf50;
         color: #fff;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         text-decoration: none;
         margin: 2px;
      }

      .btn-update:hover {
         opacity: 0.8;
      }

      .btn-cancel  {
        display: inline-block;
         padding: 8px 15px;
         font-size: 15px;
         background-color: #4caf50;
         color: #fff;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         text-decoration: none;
         margin: 2px;
      }

      .btn-save:hover,
      .btn-cancel:hover {
         background-color: #45a049;
      }

      .form-group img {
         max-width: 200px;
         display: none;
         margin-top: 10px;
      } */
</style>
</head>
<body>
   <section class="page">
      <div class="container">
         <div class="categories-section">
           

            <div class="form-container">
            <h3>Room Category Form</h3>
               <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="room_name">Add New Category</label>
                     <input type="text" id="room_name" name="room_name" placeholder="Enter category name" required>
                  </div>
                  <div class="form-group">
                     <label for="price">Price</label>
                     <input type="number" id="room_price" name="room_price" placeholder="Enter price" required>
                  </div>
                  <div class="form-group">
                     <label for="area">Area</label>
                     <input type="text" id="area" name="area" placeholder="Enter area" required>
                  </div>
                  <div class="form-group">
                     <label for="quantity">Quantity</label>
                     <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>
                  </div>
                  <div class="form-group">
                     <label for="adult">Adult (Max)</label>
                     <input type="number" id="adult" name="adult" placeholder="Enter max adult count" required>
                  </div>
                  <div class="form-group">
                     <label for="children">Children (Max)</label>
                     <input type="number" id="children" name="children" placeholder="Enter max children count" required>
                  </div>
                  <div class="form-group">
                     <label for="features">Features</label>
                     <div class="checkbox-group">
                        <input type="checkbox" id="bedroom" name="features[]" value="Bedroom">
                        <label for="bedroom">Bedroom</label>
                        <input type="checkbox" id="balcony" name="features[]" value="Balcony">
                        <label for="balcony">Balcony</label>
                        <input type="checkbox" id="kitchen" name="features[]" value="Kitchen">
                        <label for="kitchen">Kitchen</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="facilities">Facilities</label>
                     <div class="checkbox-group">
                        <input type="checkbox" id="wifi" name="facilities[]" value="WiFi">
                        <label for="wifi">WiFi</label>
                        <input type="checkbox" id="air" name="facilities[]" value="Air Conditioning">
                        <label for="air">Air Conditioning</label>
                        <input type="checkbox" id="telephone" name="facilities[]" value="Telephone">
                        <label for="telephone">Telephone</label>
                        <input type="checkbox" id="spa" name="facilities[]" value="Spa">
                        <label for="spa">Spa</label>
                        <input type="checkbox" id="room_heater" name="facilities[]" value="Room Heater">
                        <label for="room_heater">Room Heater</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="desc">Description</label>
                     <textarea id="desc" name="desc" placeholder="Enter description" required></textarea>
                  </div>
                  <div class="form-group">
                     <label for="room_image">Image</label>
                     <input id="room_image" type="file" accept="image/png, image/jpeg, image/jpg" name="room_image" required>
                  </div>

                  <div class="form-group">
                     <label for="image_preview">Image Preview</label>
                     <img id="image_preview" src="#" alt="Image Preview">
                  </div>

                  <div class="form-buttons">
                     <input type="submit" value="Save" class="btn-update" name="add_room" class="btn-save">
                     <a href="display_room.php" class="btn-cancel">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>

   <script>
      function readURL(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               document.getElementById('image_preview').src = e.target.result;
               document.getElementById('image_preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
         }
      }

      document.getElementById('room_image').addEventListener('change', function() {
         readURL(this);
      });
     
   </script>

</body>
</html>
