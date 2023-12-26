

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
      $insertQuery = "INSERT INTO gallery (gallery_image) VALUES ('$imagePath')";
      mysqli_query($conn, $insertQuery);
      header("Location: gallery.php");
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
  $imagePath = $row['gallery_image'];

  // Delete image file from the server
  if (unlink($imagePath)) {
    // Delete image record from the database
    $deleteQuery = "DELETE FROM gallery WHERE id = $imageId";
    mysqli_query($conn, $deleteQuery);
    header("Location: gallery.php");
    exit();
  }
}

// Fetch Gallery Images
$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery</title>
  <style>
    /* CSS styles for the gallery section */
    .gallery .swiper-slide.slide {
      position: relative;
    }

    .gallery .swiper-slide.slide img {
      width: 100%;
      height: auto;
    }

    .gallery .swiper-slide.slide .icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 2rem;
      color: #fff;
      opacity: 0;
      transition: opacity 0.3s ease;
      cursor: pointer;
    }

    .gallery .swiper-slide.slide:hover .icon {
      opacity: 1;
    }
  </style>
</head>
<body>
  <section class="gallery" id="gallery">
    <h1 class="heading">our gallery</h1>

    <div class="swiper gallery-slider">
      <div class="swiper-wrapper">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="swiper-slide slide">
            <img src="<?php echo $row['gallery_image']; ?>" alt="" />
            <div class="icon">
              <i class="fas fa-magnifying-glass-plus"></i>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- Add Image Form -->
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="image" required>
      <button type="submit" name="addImage">Add Image</button>
    </form>
  </section>
</body>
</html>
