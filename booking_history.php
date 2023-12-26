<?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect=booking_history.php"); // Redirect to the login page
    exit;
}

// Get the user ID
$userId = $_SESSION['user_id'];

// Retrieve the booking details for the user from the database
$bookingQuery = mysqli_query($conn,  "SELECT * FROM bookings WHERE user_id = $userId
UNION
SELECT * FROM check_in WHERE user_id = $userId
UNION
SELECT * FROM checked_out WHERE user_id = $userId");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      /* background-color: #f2f2f2; */
      padding: 20px;
      margin-top:90px;
      margin-left: 30px;
    }

    h1 {
      font-size: 3.5rem;
      
      text-transform: uppercase;
      
    }

    /* .booking-list {
      max-width: 450px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: grid;
      border: 2px solid #fff;
    }

    .booking-item {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #ccc;
      display:grid;
    } */
    
    .booking-list {
  max-width: 1000px;
  /* margin: 0 auto; */
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Use auto-fill to create a flexible grid */
  gap: 20px; /* Add gap between grid items */
}

.booking-item {
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #ccc;
  display: grid;
}

    /* .booking-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    } */

    .booking-item h2 {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }

    .booking-item p {
      font-size: 2.0rem;
      
      margin-bottom: 5px;
    }

    .booking-item .label {
      font-weight: bold;
    }

    .view-details-button {
      text-align: center;
      margin-top: 10px;
    }

    .view-details-button a {
      padding: 8px 16px;
      border-radius: 5px;
      background-color: #3e80c2;
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Booking History</h1>

  <div class="booking-list">
    <?php while ($bookingResult = mysqli_fetch_assoc($bookingQuery)) {
      $roomId = $bookingResult['room_id'];
      $roomQuery = mysqli_query($conn, "SELECT * FROM room_categories WHERE room_id = $roomId");
      $roomResult = mysqli_fetch_assoc($roomQuery);
      $roomPrice = $roomResult['price'];
      $roomArea = $roomResult['area'];
     
      
      // Get the booking order ID from the database
      $bookOrderId = $bookingResult['booking_order_id'];
    
    ?>
      <div class="booking-item">
        <h1><?php echo $roomResult['name']; ?></h1>
        <p><span >$ <?php echo $roomResult['price']; ?></span>perday</p><br>
        <p><span class="label">Check-in Date:</span> <?php echo $bookingResult['checkin_date']; ?></p>
        <p><span class="label">Checkout Date:</span> <?php echo $bookingResult['checkout_date']; ?></p>
        <p><span class="label">Check-in Time:</span> <?php echo $bookingResult['checkin_time']; ?></p><br>
        <!-- <p><span class="label">Number of Stays:</span> <?php echo $bookingResult['number_of_stays']; ?></p> -->
        <p><span class="label">Booking Order ID:</span> <?php echo $bookOrderId; ?></p>
        <p><span class="label">Total Amount:</span> $<?php echo $bookingResult['total_price']; ?></p>
        <p><span class="label">Payment Method:</span> <?php echo $bookingResult['payment_method']; ?></p>
        <div class="view-details-button">
          <a href="room_details.php?room_id=<?php echo $roomId; ?>">View Room Details</a>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>


