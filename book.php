<?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect=book.php"); // Redirect to the login page
    exit;
}

// Get the user ID
$userId = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["guest_name"];
    $contact = $_POST["contact"];
    $paymentMethod = $_POST["paymentMethod"];
    $checkinDate = $_POST["checkinDate"];
    $checkinTime = $_POST["checkinTime"];
    $checkoutDate = $_POST["checkoutDate"];

    // Calculate the number of stays
    $checkinTimestamp = strtotime($checkinDate . ' ' . $checkinTime);
    $checkoutTimestamp = strtotime($checkoutDate);
    $numberOfStays = ($checkoutTimestamp - $checkinTimestamp) / (60 * 60 * 24);

    // Retrieve the room ID from the query string
    $roomId = $_GET["room_id"];

     // Retrieve the room details from the database based on the room ID
     $roomQuery = mysqli_query($conn, "SELECT * FROM room_categories WHERE room_id = $roomId");
     $roomResult = mysqli_fetch_assoc($roomQuery);
     $roomName = $roomResult["name"]; // Get the room name
     $roomPrice = $roomResult["price"];


    // Calculate the total price
    $totalPrice = $roomPrice * $numberOfStays;

    // Generate random booking order ID
    $bookingOrderId = generateBookingOrderId();

    // Perform the booking and insert the booking details into the database
    $insertQuery = mysqli_query($conn, "INSERT INTO `bookings`(`booking_order_id`, `room_id`,`room_name`, `user_id`, `name`, `contact`, `payment_method`, `checkin_date`, `checkin_time`, `checkout_date`, `number_of_stays`, `total_price`) VALUES ('$bookingOrderId','$roomId','$roomName','$userId','$name','$contact','$paymentMethod','$checkinDate','$checkinTime','$checkoutDate','$numberOfStays','$totalPrice')");

    // Redirect to a confirmation page or display an error message
    if ($insertQuery) {
        // Redirect to a confirmation page
        header("Location: confirmation.php");
        exit();
    } else {
        // Display an error message
        echo "An error occurred while booking. Please try again.";
    }
}

function generateBookingOrderId()
{
    $length = 8;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// Retrieve the room ID from the query string
$roomId = $_GET["room_id"];

// Retrieve the room details from the database based on the room ID
$roomQuery = mysqli_query($conn, "SELECT * FROM room_categories WHERE room_id = $roomId");
$roomResult = mysqli_fetch_assoc($roomQuery);
$roomName = $roomResult["name"];
$roomPrice = $roomResult["price"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            font-size: 3.5rem;
            color: #444;
            margin-bottom: 3rem;
            text-transform: uppercase;
            text-align: center;
        }

        .booking-form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            font-size: 15px;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group .stays {
            font-size: 16px;
            font-weight: bold;
        }

        .total-price {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
            font-size: 15px;
        }

        .confirmation-button {
            text-align: right;
            margin-top: 20px;
        }

        .confirmation-button button {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            background-color: #3e80c2;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .confirmation-button .cancel {
            background-color: #e53935;
        }

        .confirmation-button button:hover {
            background-color: #2c5e9e;
        }
    </style>
</head>
<body>
<h1>Booking Form</h1>

<div class="booking-form">
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="guest_name" name="guest_name" required>
        </div>

        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
        </div>

        <div class="form-group">
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash">Cash</option>
            </select>
        </div>

        <div class="form-group">
            <label for="checkinDate">Check-in Date:</label>
            <input type="date" id="checkinDate" name="checkinDate" required>
        </div>

        <div class="form-group">
            <label for="checkinTime">Check-in Time:</label>
            <input type="time" id="checkinTime" name="checkinTime" required>
        </div>

        <div class="form-group">
            <label for="checkoutDate">Checkout Date:</label>
            <input type="date" id="checkoutDate" name="checkoutDate" required>
        </div>

        <div class="form-group">
            <label for="numberOfStays">Number of Stays:</label>
            <span class="stays" id="numberOfStaysValue">0</span>
        </div>

        <div class="total-price">
            Total Price: $<?php echo $roomPrice; ?> x <span id="numberOfStaysValue"></span> = $
            <span id="totalPriceValue">0</span>
        </div>
        <div class="confirmation-button">
            <button type="submit">Confirm Booking</button>
            <button type="button" class="cancel" onclick="goBack()">Cancel</button>
        </div>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }

    // Update the number of stays and total price based on the check-in and checkout dates
    const checkinDateInput = document.getElementById('checkinDate');
    const checkoutDateInput = document.getElementById('checkoutDate');
    const numberOfStaysValue = document.getElementById('numberOfStaysValue');
    const totalPriceValue = document.getElementById('totalPriceValue');
    const roomPrice = <?php echo $roomPrice; ?>;

    const updateNumberOfStaysAndTotalPrice = () => {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        // Calculate the number of stays
        const oneDayMilliseconds = 24 * 60 * 60 * 1000;
        const numberOfStays = Math.ceil((checkoutDate - checkinDate) / oneDayMilliseconds);

        // Update the number of stays value
        numberOfStaysValue.textContent = numberOfStays;

        // Update the total price value
        totalPriceValue.textContent = roomPrice * numberOfStays;
    };

    // Attach event listeners to the input fields
    checkinDateInput.addEventListener('change', updateNumberOfStaysAndTotalPrice);
    checkoutDateInput.addEventListener('change', updateNumberOfStaysAndTotalPrice);
</script>
</body>
</html>
