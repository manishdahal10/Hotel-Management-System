<?php
ob_start();
include "dashboard.php";
@include 'connect.php';

$id = $_GET['edit'];

if (isset($_POST['update_room'])) {
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
    $facilities = isset($_POST['facilities']) ? implode(',', $_POST['facilities']) : ''; // Set empty array if not set
    $description = $_POST['description'];

    if (empty($room_name) || empty($room_price) || empty($room_image) || empty($area) || empty($quantity) || empty($adult) || empty($children) || empty($features) || empty($facilities) || empty($description)) {
        $message[] = 'Please fill out all fields';
    } else {
        $update_data = "UPDATE `room_categories` SET `name`='$room_name',`price`='$room_price',`image`='$room_image',`area`='$area',`quantity`='$quantity',`adult`='$adult',`children`='$children',`desc`='$description',`facilities`='$facilities',`features`='$features'  WHERE room_id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($room_image_tmp_name, $room_image_folder);
            header('location:display_room.php');
        } else {
            $message[] = 'Failed to update the room category!';
        }
    }
}
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
            <?php
      
      $select = mysqli_query($conn, "SELECT * FROM room_categories WHERE room_id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="room_name">Add New Category</label>
                     <input type="text" id="room_name" name="room_name"  value="<?php echo $row['name']; ?>" placeholder="Enter category name" required>
                  </div>
                  <div class="form-group">
                     <label for="price">Price</label>
                     <input type="number" id="room_price" name="room_price"  value="<?php echo $row['price']; ?>"placeholder="Enter price" required>
                  </div>
                  <div class="form-group">
                     <label for="area">Area</label>
                     <input type="text" id="area" name="area"  value="<?php echo $row['area']; ?>" placeholder="Enter area" required>
                  </div>
                  <div class="form-group">
                     <label for="quantity">Quantity</label>
                     <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" placeholder="Enter quantity" required>
                  </div>
                  <div class="form-group">
                     <label for="adult">Adult (Max)</label>
                     <input type="number" id="adult" name="adult" value="<?php echo $row['adult']; ?>" placeholder="Enter max adult count" required>
                  </div>
                  <div class="form-group">
                     <label for="children">Children (Max)</label>
                     <input type="number" id="children" name="children" value="<?php echo $row['children']; ?>" placeholder="Enter max children count" required>
                  </div>
                  <div class="form-group">
                        <label for="features">Features</label>
                        <div class="checkbox-group">
                            <?php
                            $features = explode(',', $row['features']);
                            $featureValues = ['Bedroom', 'Balcony', 'Kitchen'];

                            foreach ($featureValues as $feature) {
                                $checked = (in_array($feature, $features)) ? 'checked' : '';
                                echo '<input type="checkbox" id="' . strtolower(str_replace(' ', '_', $feature)) . '" name="features[]" value="' . $feature . '" ' . $checked . '>';
                                echo '<label for="' . strtolower(str_replace(' ', '_', $feature)) . '">' . $feature . '</label>';
                            }
                            ?>
                        </div>
                        </div>

           <div class="form-group">
            <label for="facilities">Facilities</label>
         <div class="checkbox-group">
        <?php
         $facilities = explode(',', $row['facilities']);
        $facilityValues = ['WiFi', 'Air Conditioning', 'Telephone', 'Spa', 'Room Heater'];

        foreach ($facilityValues as $facility) {
         $checked = (in_array($facility, $facilities)) ? 'checked' : '';
         echo '<input type="checkbox" id="' . strtolower(str_replace(' ', '_', $facility)) . '" name="facilities[]" value="' . $facility . '" ' . $checked . '>';
         echo '<label for="' . strtolower(str_replace(' ', '_', $facility)) . '">' . $facility . '</label>';
      }
         ?>
                </div>
                </div>
                <div class="form-group">
   <label for="description">Description</label>
   <textarea id="description" name="description" required><?php echo $row['desc']; ?></textarea>
</div>

<div class="form-group">
                     <label for="room_image">Image</label>
                     <input id="room_image"  type="file" accept="image/png, image/jpeg, image/jpg" name="room_image" required>
                  </div>

                  <div class="form-group">
                     <label for="image_preview">Image Preview</label>
                     <img id="image_preview" src="#" alt="Image Preview">
                  </div>




                  <div class="form-buttons">
                     <input type="submit" value="Save" class="btn-update" name="update_room" >
                     <a href="display_room.php" class="btn-cancel">Cancel</a>
                  </div>
               </form>
            </div>
            <?php }; ?>
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
