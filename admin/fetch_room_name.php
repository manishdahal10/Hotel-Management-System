<?php
include "connect.php";

if (isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];

    // Retrieve room name from the "room_categories" table
    $select_sql = "SELECT name FROM room_categories WHERE id = '$room_id'";
    $result = $conn->query($select_sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        echo $row["name"];
    } else {
        echo "Room not found";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
