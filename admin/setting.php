<?php
ob_start();
include "dashboard.php";
include "connect.php";

?>
<?php

// Retrieve the "about us" data from the database
$query = "SELECT * FROM about_us";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Check if there is any existing "about us" content
if (!$row) {
    // If no content exists, redirect to the edit page
    header("Location: edit_about.php");
    exit();
  }

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      /* padding: 20px; */
    }
 

    .about-container {
      max-width: 1000px;
      margin-left: 300px;
     height: 800px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
   
    .about-image {
        margin-top:110px;
      text-align: center;
      margin-bottom: 20px;
    }

    .about-image img {
      max-width: 60%;
      height: auto;
      border-radius: 5px;
      margin-right:20px;
      float: left;
    }

    .about-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    .about-content {
      line-height: 1.5;
      color: #666;
    }

    .edit-link {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 5px;
      background-color: #3e80c2;
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      margin-top: 20px;
    }
  </style>
</head>
<body>
    <section class="aboutuspage">
  <div class="about-container">
    <div class="about-image">
      <img src="./uploaded_img/<?php echo $row['about_image']; ?>" alt="About Us Image">
    </div>
    <h2 class="about-title"><?php echo $row['about_title']; ?></h2>
    <p class="about-content"><?php echo $row['about_content']; ?></p>
    <a href="edit_about.php" class="edit-link">Edit</a>
  </div>
<section>


<?php
include 'connect.php';


// Add Image
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addImage'])) {
  $image = $_FILES['image'];

  // Check if image file is selected
  if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'uploaded_img/';
    $imageName = $image['name'];
    $imagePath = 'uploaded_img/' . $imageName;

    // Move uploaded image to destination folder
    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
      // Insert image path into the database
      $insertQuery = "INSERT INTO gallery (gallery_image) VALUES ('$imageName')";
      mysqli_query($conn, $insertQuery);
      header("Location: setting.php");
      exit();
    }
  }
}


// Delete Image
if (isset($_GET['deleteImage'])) {
    $imageId = $_GET['deleteImage'];
  
    // Get image path from the database
    $selectQuery = "SELECT gallery_image FROM gallery WHERE id = $imageId";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
  

    if (($row)) {
      // Delete image record from the database
      $deleteQuery = "DELETE FROM gallery WHERE id = $imageId";
      mysqli_query($conn, $deleteQuery);
      header("Location: setting.php");
      exit();
    }
  }
  
  

// Fetch Gallery Images
$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);
?>

<style>
    .gallery {
  margin-top: 90px;
  max-width: 1000px;
  margin-left: 300px;
  height: 800px;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
}

.gallery .heading {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.gallery .image-grid {
  margin-top: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  gap: 20px;
}

.gallery .image-card {
  position: relative;
  width: calc(50% - 10px);
  height: 0;
  padding-bottom: 38%;
}

.gallery .image-card img {
  width: 100%;
  height: 350px;
  object-fit: cover;
  border-radius: 5px;
}

.gallery .image-card .delete-button {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: #ff4444;
  color: #fff;
  padding: 6px 12px;
  border-radius: 50%;
  cursor: pointer;
}

.gallery .add-image-form {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.gallery .add-image-form input[type="file"] {
  margin-right: 10px;
}

.gallery .add-image-form button {
  background-color: #4444ff;
  color: #fff;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>
<section class="gallery">
    <h1 class="heading">Our Gallery</h1>
   
      <!-- Add Image Form -->
    <form method="POST" enctype="multipart/form-data" class="add-image-form">
      <input type="file" name="image" required>
      <button type="submit" name="addImage">Add Image</button>
    </form>

    <div class="image-grid">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="image-card">
          <img src="uploaded_img/<?php echo $row['gallery_image']; ?>" alt="" />
          <a href="?deleteImage=<?php echo $row['id']; ?>" class="delete-button">X</a>
          
        </div>
      <?php } ?>
    </div>

   
  </section>
</body>
</html>
