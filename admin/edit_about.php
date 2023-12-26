<?php
ob_start();
include 'connect.php';
include 'dashboard.php';

// Initialize variables for the form inputs
$aboutTitle = '';
$aboutContent = '';
$aboutImage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $aboutTitle = $_POST["aboutTitle"];
  $aboutContent = $_POST["aboutContent"];
  $image = $_FILES["aboutImage"];

  // Check if there is existing "about us" content
  $query = "SELECT * FROM about_us";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    // Update the existing "about us" content
    $updateQuery = "UPDATE about_us SET about_title=?, about_content=?";
    $statement = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($statement, 'ss', $aboutTitle, $aboutContent);
    mysqli_stmt_execute($statement);
  } else {
    // Insert the new "about us" content
    $insertQuery = "INSERT INTO about_us (about_title, about_content) VALUES (?, ?)";
    $statement = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($statement, 'ss', $aboutTitle, $aboutContent);
    mysqli_stmt_execute($statement);
  }

  // Handle the image upload
  if ($image && $image['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'uploaded_img/';
    $imageName = $image['name'];
    $imagePath = 'uploaded_img/' . $imageName;
    move_uploaded_file($image['tmp_name'], $imagePath);

    // Update the "about us" image path in the database
    $updateImageQuery = "UPDATE about_us SET about_image=?";
    $statement = mysqli_prepare($conn, $updateImageQuery);
    mysqli_stmt_bind_param($statement, 's', $imageName);
    mysqli_stmt_execute($statement);
  }

  // Redirect back to the about page after saving the content
  header("Location: setting.php");
  exit();
} else {
  // Retrieve the existing "about us" content for pre-filling the form
  $query = "SELECT * FROM about_us";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  // Check if there is existing content and populate the form variables
  if ($row) {
    $aboutTitle = $row["about_title"];
    $aboutContent = $row["about_content"];
    $aboutImage = $row["about_image"];
  }

  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit About Us</title>
  <style>
    /* CSS styles for the form and image preview */
    .edit-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }
 
    .editpage{
        margin-top:95px;
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
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .textabout{
        height:200px;
    }

    button[type="submit"] {
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      background-color: #3e80c2;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .image-preview {
      margin-bottom: 20px;
    }

    .image-preview img {
      /* max-width: 100%;
      height: auto;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
    }
    .form-group img {
         max-width: 200px;
         display: none;
         margin-top: 10px;
      }

      .cancel-button {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        background-color: #e53935;
        color: #fff;
        border: none;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none;
      }
  </style>
</head>
<body>
  <div class="edit-container">
    <div class="editpage">
    <h2>Edit About Us</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
      <div class="form-group">
        <label for="aboutTitle">About Us Title:</label>
        <input type="text" id="aboutTitle" name="aboutTitle" value="<?php echo $aboutTitle; ?>" required>
      </div>

      <div class="form-group">
        <label for="aboutContent">About Us Content:</label>
        <textarea id="aboutContent" name="aboutContent" class="textabout" required><?php echo $aboutContent; ?></textarea>
      </div>
       

      <div class="form-group">
                     <label for="aboutImage">Image</label>
                     <input id="aboutImage" type="file" accept="image/png, image/jpeg, image/jpg" name="aboutImage" required>
                  </div>

                  <div class="form-group">
                     <label for="image_preview">Image Preview</label>
                     <img id="image_preview" src="#" alt="Image Preview">
                  </div>
      <!-- <div class="form-group">
        <label for="aboutImage">About Us Image:</label>
        <input type="file" id="aboutImage" name="aboutImage">
      </div>

      <div class="image-preview">
        <?php if ($aboutImage) { ?>
          <img src="<?php echo $aboutImage; ?>" alt="About Us Image">
        <?php } ?>
      </div> -->

      <div class="form-group">
        <button type="submit">Save</button>
        <a href="setting.php" class="cancel-button">Cancel</a>
      </div>
    </form>
  </div>
</body>
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

      document.getElementById('aboutImage').addEventListener('change', function() {
         readURL(this);
      });
     
   </script>
</html>
