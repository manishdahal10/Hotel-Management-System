<?php
// Include your database connection file
include 'connect.php';

if (isset($_GET['id'])) {
   $roomId = $_GET['id'];

   // Fetch room data from the database based on the room ID
   $query = "SELECT * FROM room_categories WHERE id = $roomId";
   $result = mysqli_query($conn, $query);

   if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // Display room data in the modal content
      echo '<h3>' . $row['name'] . '</h3>';
      echo '<p>Price: $' . number_format($row['price'], 2) . '</p>';
      // Add more data fields as needed
   } else {
      echo 'No data found';
   }
}

// Close the database connection
mysqli_close($conn);
?>
