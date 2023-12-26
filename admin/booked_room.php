<?php
ob_start();
// include "dashboard.php";

// Database connection
include "connect.php";

// Function to escape HTML output for security
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Handle delete action
if (isset($_GET["delete"])) {
    $bookingIdToDelete = $_GET["delete"];
    $deleteQuery = "DELETE FROM bookings WHERE booking_order_id=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $bookingIdToDelete);
    $stmt->execute();

    // Redirect to refresh the page after deleting
    header("Location: booked_room.php");
    exit;
}

// Handle form submission for updating booking details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["booking_id"])) {
        $bookingId = $_POST["booking_id"];
        $name = $_POST["name"];
        $contact = $_POST["contact"];
        $paymentMethod = $_POST["payment_method"];
        $checkinDate = $_POST["checkin_date"];
        $checkinTime = $_POST["checkin_time"];
        $checkoutDate = $_POST["checkout_date"];
        $numberOfStays = $_POST["number_of_stays"];
        $totalPrice = $_POST["total_price"];

        // Perform the database update here
        // Update the corresponding fields in the "bookings" table
        $updateQuery = "UPDATE bookings SET name=?, contact=?, payment_method=?, checkin_date=?, checkin_time=?, checkout_date=?, number_of_stays=?, total_price=? WHERE booking_order_id=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssds", $name, $contact, $paymentMethod, $checkinDate, $checkinTime, $checkoutDate, $numberOfStays, $totalPrice, $bookingId);
        $stmt->execute();
    }
}

// Retrieve booked rooms from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked Rooms</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Booked Rooms</h1>

    <table>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Payment Method</th>
            <th>Check-in Date</th>
            <th>Check-in Time</th>
            <th>Checkout Date</th>
            <th>Number of Stays</th>
            <th>Total Price</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            $count = 1; // Counter variable
            // Output data for each booked room
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $count . '</td>';
                echo '<td>' . escape($row["booking_order_id"]) . '</td>';
                echo '<td>' . escape($row["name"]) . '</td>';
                echo '<td>' . escape($row["contact"]) . '</td>';
                echo '<td>' . escape($row["payment_method"]) . '</td>';
                echo '<td>' . escape($row["checkin_date"]) . '</td>';
                echo '<td>' . escape($row["checkin_time"]) . '</td>';
                echo '<td>' . escape($row["checkout_date"]) . '</td>';
                echo '<td>' . escape($row["number_of_stays"]) . '</td>';
                echo '<td>' . escape($row["total_price"]) . '</td>';
                echo '<td>';
                echo '<button onclick="openEditModal(\'' . escape($row["booking_order_id"]) . '\')">Edit</button>';
                echo '<a href="booked_room.php?delete=' . escape($row["booking_order_id"]) . '">Delete</a>';
                echo '</td>';
                echo '</tr>';
                $count++;
            }
        } else {
            echo '<tr><td colspan="11">No booked rooms found.</td></tr>';
        }
        ?>
    </table>

    <!-- Modal for editing booking details -->
    <div id="editModal" style="display: none;">
        <h2>Edit Booking</h2>
        <form method="POST">
            <input type="hidden" name="booking_id" id="booking_id">
            <!-- Add your form fields for editing here -->
            <!-- Example: -->
            <!-- <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br> -->
            <!-- ... -->

            <input type="submit" value="Save Changes">
        </form>
    </div>

    <script>
        // Function to open the edit form modal and populate the form fields
        function openEditModal(bookingId) {
            document.getElementById("booking_id").value = bookingId;
            document.getElementById("editModal").style.display = "block";

            // Fetch existing booking details from the server (optional)
            // If you want to pre-fill the form with existing data, you can fetch the details using AJAX.
            // Replace the URL below with the actual PHP file to fetch the booking details by ID.
            fetch("fetch_booking_details.php?booking_id=" + bookingId)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    // Update the form fields with the fetched data
                    // Example: document.getElementById("name").value = data.name;
                })
                .catch(function(error) {
                    console.log("Error fetching booking details: ", error);
                });
        }

        // Function to close the edit form modal
        function closeEditModal() {
            document.getElementById("editModal").style.display = "none";
        }
    </script>
</body>
</html>
