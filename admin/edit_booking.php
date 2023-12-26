<?php
ob_start();
include "dashboard.php";
include "connect.php";

// Check if the booking ID is provided in the query string
if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    // Retrieve booking details from the database
    $select_sql = "SELECT * FROM check_in WHERE booking_order_id = '$bookingId'";
    $result = $conn->query($select_sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Booking not found.";
        exit;
    }
} else {
    echo "Booking ID not provided.";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and update the form data
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
    
       
    
         // Retrieve the room details from the database based on the room ID
         $roomQuery = mysqli_query($conn, "SELECT * FROM room_categories ");
         $roomResult = mysqli_fetch_assoc($roomQuery);
         $roomName = $roomResult["name"]; // Get the room name
         $roomPrice = $roomResult["price"];
    
    
        // Calculate the total price
        $totalPrice = $roomPrice * $numberOfStays;

    // Update the booking data in the database
    $update_sql = "UPDATE check_in SET guest_name = '$name', total_price='$totalPrice', number_of_stays='$numberOfStays', contact = '$contact', payment_method = '$paymentMethod', room_name= '$roomName', checkin_date = '$checkinDate', checkin_time = '$checkinTime', checkout_date = '$checkoutDate' WHERE booking_order_id = '$bookingId'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: check_in.php?msg=Booking updated successfully");
        exit();
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Booking</title>
    <style>
        /* Your CSS styles here */
       

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

    </style>
</head>
<body>
    <section class="booking-form">
        <br><br><br><br>
        <h1>Edit Booking</h1>

        <form method="POST">
            <div class="form-group">
                <label for="guest_name">Name:</label>
                <input type="text" id="guest_name" name="guest_name" value="<?php echo $row['guest_name']; ?>" required>
            </div>


        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>
        </div>
        <div class="form-group">
    <label for="room">Room:</label>
    <select id="room" name="room_name" required>
        <?php
        // Retrieve room names from the room_categories table
        $roomQuery = mysqli_query($conn, "SELECT * FROM room_categories");
        while ($roomResult = mysqli_fetch_assoc($roomQuery)) {
            $selected = ($row['room_name'] == $roomResult['name']) ? 'selected' : '';
            echo '<option value="' . $roomResult['name'] . '" ' . $selected . '>' . $roomResult['name'] . '</option>';
        }
        ?>
    </select>
</div>
        <div class="form-group">
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" value="<?php echo $row['payment_method']; ?>" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash">Cash</option>
            </select>
        </div>

        <div class="form-group">
            <label for="checkinDate">Check-in Date:</label>
            <input type="date" id="checkinDate" name="checkinDate" value="<?php echo $row['checkin_date']; ?>" required>
        </div>

        <div class="form-group">
            <label for="checkinTime">Check-in Time:</label>
            <input type="time" id="checkinTime" name="checkinTime" value="<?php echo $row['checkin_time']; ?>" required>
        </div>

        <div class="form-group">
            <label for="checkoutDate">Checkout Date:</label>
            <input type="date" id="checkoutDate" name="checkoutDate" value="<?php echo $row['checkout_date']; ?>" required>
        </div>

        <div class="form-group">
            <label for="numberOfStays">Number of Stays:</label>
            <span class="stays" id="numberOfStaysValue">0</span>
        </div>

        <div class="total-price">
        <?php
// Retrieve room names from the room_categories table
$roomQuery = mysqli_query($conn, "SELECT * FROM room_categories");
while ($roomResult = mysqli_fetch_assoc($roomQuery)) {
    $selected = ($row['room_name'] == $roomResult['name']) ? 'selected' : '';
    if ($selected) {
        $selectedRoomPrice = $roomResult['price'];
    }
}
?>
<div class="total-price">
    <!-- Total Price: $<?php echo $selectedRoomPrice; ?> x <span id="numberOfStaysValue"></span> = $ -->
    Total Price:<span id="numberOfStaysValue"></span> = $
    <span id="totalPriceValue">0</span>
</div>
        <div class="confirmation-button">
            <button type="submit">Update</button>
            <button type="button" class="cancel" onclick="goBack()">Cancel</button>
        </div>
    </form>
</div>
    </section>

    
    <script>
    function goBack() {
        window.history.back();
    }

    // Store room prices from the "room_categories" table in a JavaScript object
    const roomPrices = {
        <?php
        $roomQuery = mysqli_query($conn, "SELECT * FROM room_categories");
        while ($roomResult = mysqli_fetch_assoc($roomQuery)) {
            echo "'" . $roomResult['name'] . "': " . $roomResult['price'] . ",";
        }
        ?>
    };

    function goBack() {
        window.history.back();
    }

    // Update the number of stays and total price based on the check-in and checkout dates
    const checkinDateInput = document.getElementById('checkinDate');
    const checkoutDateInput = document.getElementById('checkoutDate');
    const roomDropdown = document.getElementById('room'); // Get the room dropdown element
    const numberOfStaysValue = document.getElementById('numberOfStaysValue');
    const totalPriceValue = document.getElementById('totalPriceValue');

    const updateNumberOfStaysAndTotalPrice = () => {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        // Calculate the number of stays
        const oneDayMilliseconds = 24 * 60 * 60 * 1000;
        const numberOfStays = Math.ceil((checkoutDate - checkinDate) / oneDayMilliseconds);

        // Retrieve the selected room name from the dropdown
        const selectedRoomName = roomDropdown.value; // Use the room dropdown

        // Get the room price from the roomPrices object based on the selected room name
        const roomPrice = roomPrices[selectedRoomName];

        // Update the number of stays value
        numberOfStaysValue.textContent = numberOfStays;

        // Update the total price value
        totalPriceValue.textContent = roomPrice * numberOfStays;
    };

    // Attach event listeners to the input fields and room dropdown
    checkinDateInput.addEventListener('change', updateNumberOfStaysAndTotalPrice);
    checkoutDateInput.addEventListener('change', updateNumberOfStaysAndTotalPrice);
    roomDropdown.addEventListener('change', updateNumberOfStaysAndTotalPrice); // Attach to the room dropdown

    // Initial calculation
    updateNumberOfStaysAndTotalPrice();
</script>