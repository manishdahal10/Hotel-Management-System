 <?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Page</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* Body Styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }

    /* Header Styles */
    h1 {
      /* text-align: center;
      color: #333;
      margin-bottom: 20px;
      font-size: 32px; */
      font-size: 3.5rem;
  color: #444;
  margin-bottom: 3rem;
  text-transform: uppercase;
  text-align: center;
    }

    /* Room Gallery Styles */
    .room-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      grid-gap: 20px;
      /* display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  gap: 2rem; */
    }

    /* Room Card Styles */
    .room-card {
      /* background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease-in-out;
      cursor: pointer; */
      text-align: center;
  padding: 3rem 2rem;
  background: #fff;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  outline: 0.1rem solid #ccc;
  outline-offset: -1.5rem;
  cursor: pointer;
    }

    .room-card:hover {
      /* transform: translateY(-5px); */
      outline: 0.2rem solid #4545;
  outline-offset: 0;
    }

    .room-image {
      width: 100%;
      /* max-height: 200px; */
      object-fit: cover;
      border-radius: 5px;
      margin-bottom: 10px;
      height: 18rem;
    }
    

    .room-name {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 5px;
      font-family: italic;
      color: #3e80c2;
    }

    /* Room Popup Styles */
    .room-popup {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease-in-out;
      z-index: 9999;
      
    
    }

    .room-popup.show {
      opacity: 1;
      visibility: visible;
    }

    .room-popup-content {
      
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      max-width: 1500px;
      max-height: 600px;
      text-align: center;
      position: relative;
      float:left;
    }

    .room-popup-image {
     
      max-width: 60%;
      /* max-height: 400px; */
      object-fit: cover;
      border-radius: 5px;
      
      margin-right:10px;
      float: left;
    }

    .room-popup-name {
      /* font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px; */
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 25px;
      font-family: italic;
      color: #3e80c2;
    }

    .room-popup-details {
  max-width: 1300px;
  text-align: left;
  font-size: 18px;

}

   
    .room-popup-buttons {
      display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 1rem;
    }

    .room-popup-buttons button {
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }

    .room-popup-buttons button.book {
      background-color: #e53935;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease-in-out;
    }

    .room-popup-buttons button.book:hover {
      background-color: #c62828;
    }

    .room-popup-buttons button.show-more {
      background-color: #333;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease-in-out;
    }

    .room-popup-buttons button.show-more:hover {
      background-color: #222;
    }

    .close-popup {
      font-size: 20px;
      color: #aaa;
      cursor: pointer;
      position: absolute;
      top: 10px;
      right: 10px;
      transition: color 0.3s ease-in-out;
    }

    .close-popup:hover {
      color: #333;
    }
  </style>
</head>
<body>
<?php
include "config.php";
$select = mysqli_query($conn, "SELECT * FROM room_categories");
?>
  <h1>Room Gallery</h1>
  <div class="room-gallery">
  <?php while($row = mysqli_fetch_assoc($select)){ ?>
    <!-- Room Card -->
    <div class="room-card" data-room_id="<?php echo $row['room_id']; ?>" data-name="<?php echo $row['name']; ?>" data-image="<?php echo $row['image']; ?>" data-description="<?php echo $row['desc']; ?>" data-children="<?php echo $row['children']; ?>" data-adult="<?php echo $row['adult']; ?>" data-price="<?php echo $row['price']; ?>" data-area="<?php echo $row['area']; ?>" data-facilities="<?php echo $row['facilities']; ?>" data-features="<?php echo $row['features']; ?>">
      <img class="room-image" src="./admin/uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
      <div class="room-name"><?php echo $row['name']; ?></div>
    </div>
    <?php } ?>
  </div>

  <div id="room-popup" class="room-popup">
    <div class="room-popup-content">
      <span class="close-popup" onclick="closeRoomPopup()">&times;</span>
      <img class="room-popup-image" src="" alt="Room Image">
      <div class="room-details">
        <div class="room-popup-name"></div>
        <div class="room-popup-details">
          <p><strong>Price: Rs</strong> <span class="room-popup-price"></span> per day</p> 
          <p><strong>Area:</strong> <span class="room-popup-area"></span> (sqfeet)</p> 
          <p><strong>Children (Max):</strong> <span class="room-popup-children"></span></p>
          <p><strong>Adult (Max):</strong> <span class="room-popup-adult"></span></p><br>
          <!-- <p><strong>Facilities:</strong> <span class="room-popup-facilities"></span></p>
          <p><strong>Features:</strong> <span class="room-popup-features"></span></p>
          <p><strong>Description:</strong> <span class="room-popup-description"></span></p> -->
        </div>
        <div class="room-popup-buttons">
          <button  class="book" >Book</button>
          <button class="show-more">See more</button>
        </div>
      </div>
    </div>
  </div>
  

  <script>
    $(document).ready(function() {
      $('.room-card').click(function() {
        var roomCard = $(this);
        var roomId = roomCard.data('room_id');
        var roomName = roomCard.data('name');
        var roomImage = roomCard.data('image');
        var roomPrice = roomCard.data('price');
        var roomArea = roomCard.data('area');
        var roomChildren = roomCard.data('children');
        var roomAdult = roomCard.data('adult');
        // var roomFeatures = roomCard.data('features');
        // var roomFacilities = roomCard.data('facilities');
        // var roomDescription = roomCard.data('description');

        $('.room-popup-image').attr('src', './admin/uploaded_img/' + roomImage);
        $('.room-popup-name').text(roomName);
        $('.room-popup-price').text(roomPrice);
        $('.room-popup-area').text(roomArea);
        $('.room-popup-children').text(roomChildren);
        $('.room-popup-adult').text(roomAdult);
        // $('.room-popup-facilities').text(roomFacilities);
        // $('.room-popup-features').text(roomFeatures);
        // $('.room-popup-description').text(roomDescription);
        $('.show-more').click(function() {
          window.location.href = 'views.php?room_id=' + roomId;
        });

        $('.book').click(function() {
          window.location.href = 'book.php?room_id=' + roomId;
        });
        
         
        $('.room-popup').addClass('show');
      });

      $('.close-popup').click(function() {
        $('.room-popup').removeClass('show');
      });
    });
  </script>
</body>
</html>