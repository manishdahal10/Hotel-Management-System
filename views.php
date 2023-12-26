<!-- view.php -->
<?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';
?>
<html>
<head>
  <title>View Details</title>
  <style>
   .view{
      margin-left: 150px;
      font-family: Arial, sans-serif;
      padding: 20px;
      
    }

    h1 {
    margin-top: 90px;
      color: #333;
      margin-bottom: 20px;
    }

   

    p {
        font-size: 16px;
      /* margin-bottom: 10px; */
      margin:0;

    }

    strong {
      font-weight: bold;
    } 
    img {
      margin-right:15px;
      max-width: 600px;
      max-height: 400px;
      margin-bottom: 20px;
      float: left;
    }
    a {
      color: #007bff;
      text-decoration: none;
      margin-right: 10px;
    }
    .goback  {
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
    .edit{
                   display: inline-block;
                   padding: 8px 15px;
                    font-size: 15px;
                    border-radius: 8px;
                    cursor: pointer;
                    text-decoration: none;
                    margin: 2px;
                    background-color: #e53935;
                    color: #fff;
                    border: none;
                    transition: background-color 0.3s ease-in-out;
    }
  </style>
</head>
<body>
    <div class="view">
  <?php
  $conn = mysqli_connect('localhost', 'root', '', 'ho_tel');
  
  // Retrieve the room category details based on the provided ID
  if (isset($_GET['room_id'])) {
    $id = $_GET['room_id'];
    $result = mysqli_query($conn, "SELECT * FROM room_categories WHERE room_id='$id'");
    $row = mysqli_fetch_assoc($result);

    // Display the room category details
    
    if ($row) {
      echo '<h1> Room Details: </h1>';
      echo '<img src="./admin/uploaded_img/' . $row['image'] . '">';
      echo '<p><strong>Name:</strong> ' . $row['name'] . '</p>';
      echo '<p><strong>Price:</strong> $' . $row['price'] . ' perday</p>';
      echo '<p><strong>Area:</strong> ' . $row['area'] . ' sqft</p>';
      echo '<p><strong>Adult(Max):</strong> ' . $row['adult'] . '</p>';
      echo '<p><strong>Children(Max):</strong> ' . $row['children'] . '</p><br>';
    //   echo '<p><strong>Quantity:</strong> ' . $row['quantity'] . '</p>';
      echo '<p><strong>Facilities:</strong> ' . $row['facilities'] . '</p>';
      echo '<p><strong>Features:</strong> ' . $row['features'] . '</p>';
      echo '<p><strong>Description:</strong> ' . $row['desc'] . '</p>';
      echo '<br><a href="newroom.php" class="goback">Go Back</a>';
      echo '<a href="book.php?room_id=' . $row['room_id'] . '" class="edit">Book</a>'; 
    } else {
      echo 'Room category not found.';
    }

    // Clean up
    mysqli_free_result($result);
  } else {
    echo 'Invalid request.';
  }

  mysqli_close($conn);
  ?>
  </div>
</body>
</html>
