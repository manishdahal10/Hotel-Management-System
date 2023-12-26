<?php
include "connect.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the booking ID, name, and contact from the request
    $bookingId = $_POST["bookingId"];
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $checkinDate = $_POST["checkinDate"];
    $checkoutDate = $_POST["checkoutDate"];
    $checkinTime = $_POST["checkinTime"];
    $numberOfStays = $_POST["numberOfStays"];

    // Prepare and execute the SQL query to update the booking details
    $stmt = $conn->prepare("UPDATE bookings SET name = ?, contact = ?, checkin_date = ?, checkout_date = ?, checkin_time = ?, number_of_stays = ? WHERE booking_order_id = ?");
    $stmt->bind_param("ssssssi", $name, $contact, $checkinDate, $checkoutDate, $checkinTime, $numberOfStays, $bookingId);

    if ($stmt->execute()) {
        echo "Booking details updated successfully.";
    } else {
        echo "Error updating booking details: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
