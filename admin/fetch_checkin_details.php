<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<style>
    .booking-details {
        margin-top: 20px;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 5px;
    }

    .booking-details h3 {
        margin-top: 0;
        margin-bottom: 10px;
        color: #333;
    }

    .booking-details p {
        margin-bottom: 5px;
    }

    .booking-details label {
        font-weight: bold;
    }
</style>

<?php
include "connect.php";

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    // Fetch booking details from bookings table
    $bookingSql = "SELECT * FROM check_in WHERE booking_order_id = '$bookingId'";
    $bookingResult = $conn->query($bookingSql);

    if ($bookingResult->num_rows > 0) {
        $bookingRow = $bookingResult->fetch_assoc();

        // Fetch room details from room_categories table
        $roomId = $bookingRow['room_id'];
        $roomSql = "SELECT * FROM room_categories WHERE room_id = '$roomId'";
        $roomResult = $conn->query($roomSql);

        if ($roomResult->num_rows > 0) {
            $roomRow = $roomResult->fetch_assoc();

            // Fetch user details from users table
            $userId = $bookingRow['user_id'];
            $userSql = "SELECT * FROM users WHERE user_id = '$userId'";
            $userResult = $conn->query($userSql);

            if ($userResult->num_rows > 0) {
                $userRow = $userResult->fetch_assoc();

                // Prepare the booking details response
                $response = [
                    'booking_id' => $bookingRow['booking_order_id'],
                    'room_name' => $roomRow['name'],
                    'room_price' => $roomRow['price'],
                    'user_name' => $userRow['name'],
                    'contact' => $userRow['phone'],
                    'address' => $userRow['address'],
                    'total_amount' => $bookingRow['total_price'],
                    // 'quantity' => $bookingRow['quantity'],
                    'payment_method' => $bookingRow['payment_method']
                ];

                // Convert the response to JSON format
                $jsonResponse = json_encode($response);
                echo '<div class="booking-details">';
                echo '<h3>Booking Details</h3>';
                echo '<p><label>Booking ID:</label> ' . $response['booking_id'] . '</p>';
                echo '<p><label>Room Name:</label> ' . $response['room_name'] . '</p>';
                echo '<p><label>Room Price:</label> ' . $response['room_price'] . '</p>';
                echo '<p><label>User Name:</label> ' . $response['user_name'] . '</p>';
                echo '<p><label>Contact:</label> ' . $response['contact'] . '</p>';
                echo '<p><label>Address:</label> ' . $response['address'] . '</p>';
                echo '<p><label>Total Amount:</label> $' . $response['total_amount'] . '</p>';
                echo '<p><label>Payment Method:</label> ' . $response['payment_method'] . '</p>';
                echo '</div>';
            } else {
                echo '<p>User not found.</p>';
            }
        } else {
            echo '<p>Room not found.</p>';
        }
    } else {
        echo '<p>Booking not found.</p>';
    }
} else {
    echo '<p>Invalid booking ID.</p>';
}

$conn->close();



?>
