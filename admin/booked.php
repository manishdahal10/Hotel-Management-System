<?php
ob_start();
include "dashboard.php";
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["booking_order_id"])) {
    $booking_order_id = $_POST["booking_order_id"];

    // Retrieve the booking data from the "bookings" table
    $select_sql = "SELECT * FROM bookings WHERE booking_order_id = '$booking_order_id'";
    $result = $conn->query($select_sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Insert the booking data into the "checked_out" table
        $insert_sql = "INSERT INTO check_in (booking_order_id, room_id, room_name, user_id, guest_name, contact, payment_method, checkin_date, checkin_time, checkout_date, number_of_stays, total_price)
                       VALUES ('$booking_order_id', '{$row['room_id']}', '{$row['room_name']}','{$row['user_id']}','{$row['name']}', '{$row['contact']}', '{$row['payment_method']}', '{$row['checkin_date']}', '{$row['checkin_time']}', '{$row['checkout_date']}', '{$row['number_of_stays']}', '{$row['total_price']}')";
        if ($conn->query($insert_sql) === TRUE) {
            // Delete the booking data from the "bookings" table
            $delete_sql = "DELETE FROM bookings WHERE booking_order_id = '$booking_order_id'";
            if ($conn->query($delete_sql) === TRUE) {
                header("Location: booked.php?msg=check_in successfully");
            } else {
                echo "Error deleting booking: " . $conn->error;
            }
        } else {
            echo "Error inserting check-in data: " . $conn->error;
        }
    } else {
        echo "Booking not found.";
    }
}

if (isset($_GET['delete'])) {
    $booking_order_id = $_GET['delete'];

    // Perform deletion query
    $delete_sql = "DELETE FROM bookings WHERE booking_order_id = '$booking_order_id'";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: booked.php?msg=Data deleted successfully");
    } else {
        echo "Error deleting booking: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$bookings = [];

try {
    // Create a new database connection
    $conn = new mysqli('localhost', 'root', '', 'ho_tel');

    // Query for retrieving booking records with search filters
    $sql_bookings = "SELECT * FROM bookings WHERE name LIKE '%$keyword%' OR checkin_date LIKE '%$keyword%' OR checkout_date LIKE '%$keyword%'";
    $res_bookings = $conn->query($sql_bookings);

    if ($res_bookings->num_rows > 0) {
        while ($a = $res_bookings->fetch_assoc()) {
            array_push($bookings, $a);
        }
    }
} catch (Exception $e) {
    die('Database Error : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booked Rooms</title>
    <style>
        /* Your CSS styles here */
        table {
            border-collapse: collapse;
            width: 90%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .bookroom {
            margin-left: 260px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 8% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .close {
            float: right;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }

        /* Styling for the booking details */
        #booking-details {
            /* Add your styles here */
        }

        /* Styling for buttons */
        .view-details, .check-in-btn, .edit-btn, .delete-btn {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .view-details {
            background-color: #FFC107;
            border: none;
            color: white;
        }

        .view-details:hover {
            background-color: #ffa000;
        }

        .check-in-btn {
            background-color: #007BFF;
            border: none;
            color: white;
        }

        .check-in-btn:hover {
            background-color: #0056b3;
        }

        .edit-btn {
            background-color: #FFC107;
            border: none;
            color: white;
        }

        .edit-btn:hover {
            background-color: #ffa000;
        }

        .delete-btn {
            background-color: #FF5733;
            text-decoration: none;
            border: none;
            color: white;
            float: left;
        }

        .delete-btn:hover {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
<section class="bookroom">
    <br><br><br><br>
    <h1>Booked Rooms</h1>
    <table>
        <tr>
            <th>#</th>
            <th>Booked ID</th>
            <th>Check-in Date</th>
            <th>Check-in Time</th>
            <th>Name</th>
            <th>Details</th>
            <th>Action</th>
        </tr>

        <?php
        if (!empty($bookings)) {
            $count = 1; // Counter variable
            // Output data for each booked room
            foreach ($bookings as $row) {
                echo '<tr>';
                echo '<td>' . $count . '</td>';
                echo '<td>' . $row["booking_order_id"] . '</td>';
                echo '<td>' . $row["checkin_date"] . '</td>';
                echo '<td>' . $row["checkin_time"] . '</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>
                            <button class="view-details" data-booking-id="' . $row["booking_order_id"] . '">View</button>
                        </td>';
                echo '<td>
                            <form method="post" action="">
                                <input type="hidden" name="booking_order_id" value="' . $row["booking_order_id"] . '">
                                <button type="submit" class="check-in-btn">Check-in</button>
                                <a class="delete-btn" href="#" onclick="confirmDelete(\'' . $row["booking_order_id"] . '\')">Delete</a>
                               
                            </form>
                           
                        </td>';
                echo '</tr>';
                $count++;
            }
        } else {
            echo '<tr><td colspan="7">No booked rooms found.</td></tr>';
        }
        ?>
    </table>
</section>

<div id="details-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Booking Details</h2>
        <div id="booking-details"></div>
        <!-- Edit button -->
        <!-- <button class="edit-btn">Update</button> -->
    </div>
</div>

<script>
    var viewButtons = document.getElementsByClassName("view-details");
    var detailsModal = document.getElementById("details-modal");
    var bookingDetails = document.getElementById("booking-details");
    var closeButton = document.getElementsByClassName("close")[0];
    var checkInButton = document.getElementsByClassName("check-in-btn")[0];
    var editButton = document.getElementsByClassName("edit-btn")[0];

    // Function to open the booking details modal and populate the details
    function openDetailsModal(bookingId) {
        detailsModal.style.display = "block";

        // Fetch booking details from the server
        fetch("fetch_booking_details.php?booking_id=" + bookingId)
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                bookingDetails.innerHTML = data;
            })
            .catch(function (error) {
                console.log("Error fetching booking details: ", error);
            });
    }

    // Function to close the booking details modal
    function closeDetailsModal() {
        detailsModal.style.display = "none";
    }

    // Attach event listeners to the view buttons
    for (var i = 0; i < viewButtons.length; i++) {
        viewButtons[i].addEventListener("click", function () {
            var bookingId = this.dataset.bookingId;
            openDetailsModal(bookingId);
        });
    }

    // Close modal when close button is clicked
    closeButton.addEventListener("click", closeDetailsModal);

    // Close modal when clicked outside the modal content
    window.addEventListener("click", function (event) {
        if (event.target === detailsModal) {
            closeDetailsModal();
        }
    });

    // Edit button click event handler (if needed)
    editButton.addEventListener("click", function () {
        // Implement the edit functionality here
        // You can open another modal or redirect to the edit page, etc.
        // For demonstration purposes, I have left the edit button functionality unimplemented.
    });


    // Function to confirm deletion when clicking the "Delete" button
    function confirmDelete(bookingOrderId) {
        var confirmMessage = "Are you sure you want to delete?";
        if (confirm(confirmMessage)) {
            // Redirect to the delete URL
            window.location.href = "booked.php?delete=" + bookingOrderId;
        }
    }
</script>
</body>
</html>
