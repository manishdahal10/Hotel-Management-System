<?php
ob_start();
include "dashboard.php";
include "connect.php";

// Handle POST request for checking out
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["booking_order_id"])) {
    $booking_order_id = $_POST["booking_order_id"];

    // Retrieve the booking data from the "check_in" table
    $select_sql = "SELECT * FROM check_in WHERE booking_order_id = '$booking_order_id'";
    $result = $conn->query($select_sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Insert the booking data into the "checked_out" table
        $insert_sql = "INSERT INTO checked_out (booking_order_id, room_id, room_name, user_id, guest_name, contact, payment_method, checkin_date, checkin_time, checkout_date, number_of_stays, total_price)
                       VALUES ('$booking_order_id', '{$row['room_id']}', '{$row['room_name']}', '{$row['user_id']}', '{$row['guest_name']}', '{$row['contact']}', '{$row['payment_method']}', '{$row['checkin_date']}', '{$row['checkin_time']}', '{$row['checkout_date']}', '{$row['number_of_stays']}', '{$row['total_price']}')";
        if ($conn->query($insert_sql) === TRUE) {
            // Delete the booking data from the "check_in" table
            $delete_sql = "DELETE FROM check_in WHERE booking_order_id = '$booking_order_id'";
            if ($conn->query($delete_sql) === TRUE) {
                header("Location: check_in.php?msg=Checked out successfully");
                exit; // Redirect and exit to prevent further execution
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

// Handle GET request for deleting
if (isset($_GET['delete'])) {
    $booking_order_id = $_GET['delete'];

    // Perform deletion query
    $delete_sql = "DELETE FROM check_in WHERE booking_order_id = '$booking_order_id'";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: check_in.php?msg=Data deleted successfully");
        exit; // Redirect and exit to prevent further execution
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked Rooms</title>
    <style>
        /* Your CSS styles here */
        
        table {
            border-collapse: collapse;
            width: 95%;
            margin-top:10px;
            
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
        .bookroom{
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
            background-color: green;
            border: none;
            color: white;
        }

        .view-details:hover {
            background-color: green;
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
            text-decoration: none;
            border: none;
            color: white;
        }

        .edit-btn:hover {
            background-color: #ffa000;
        }

        .delete-btn {
            background-color: #FF5733;
            border: none;
            color: white;
            float:left;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #ff0000;
        }

        /* Add this to your existing styles */
.action-buttons {
    display: flex;
    align-items: center;
}

.action-buttons button {
    margin-right: 10px;
}

    </style>
</head>
<body>
    <section class="bookroom">
        <br><br><br><br>
        <h1>Check-In Records</h1>

        <body>

        <table>
            <tr>
                <th></th>
                <th>Guest Name</th>
                <th>Room Name</th>
                <th>BookingOrderId</th>
                <th>Number of Stays</th>
                <th>Checkout_date</th>
                <th>Details</th>
                <th>Action</th>
            </tr>

            <?php
            include "connect.php";

            // Retrieve booked rooms from the database
            $sql = "SELECT * FROM check_in";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 1; // Counter variable
                // Output data for each booked room
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $row["guest_name"] . '</td>';
                    echo '<td>' . $row["room_name"] . '</td>';
                    echo '<td>' . $row["booking_order_id"] . '</td>';
                    echo '<td>' . $row["number_of_stays"] . '</td>';
                    echo '<td>' . $row["checkout_date"] . '</td>';
                    echo '<td>
                            <button class="view-details" data-booking-id="' . $row["booking_order_id"] . '">View</button>
                        </td>';
                    echo '<td class="action-buttons">';
                    echo '  <form method="post" action="">
                                <input type="hidden" name="booking_order_id" value="' . $row["booking_order_id"] . '">
                                <button type="submit" class="check-in-btn">Check-Out</button>
                                <a class="edit-btn" href="edit_booking.php?booking_id=' . $row["booking_order_id"] . '">Edit</a>
                                <a class="delete-btn" href="#" onclick="confirmDelete(\'' . $row["booking_order_id"] . '\')">Delete</a>
                            </form>';
                    echo '</td>';
                    $count++;
                }
            } else {
                echo '<tr><td colspan="7">No booked rooms found.</td></tr>';
            }

            $conn->close();
            ?>
        </table>
    </section>

    <div id="details-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Booking Details</h2>
            <div id="booking-details"></div>
        </div>
    </div>

    <script>
        var viewButtons = document.getElementsByClassName("view-details");
        var detailsModal = document.getElementById("details-modal");
        var bookingDetails = document.getElementById("booking-details");
        var closeButton = document.getElementsByClassName("close")[0];
        var checkInButton = document.getElementsByClassName("check-in-btn")[0];

        // Function to open the booking details modal and populate the details
        // function openDetailsModal(bookingId) {
        //     detailsModal.style.display = "block";

        //     // Fetch booking details from the server
        //     fetch("fetch_check.php?booking_id=" + bookingId)
        //         .then(function(response) {
        //             return response.text();
        //         })
        //         .then(function(data) {
        //             bookingDetails.innerHTML = data;
        //         })
        //         .catch(function(error) {
        //             console.log("Error fetching booking details: ", error);
        //         });
        // }
        // Function to open the booking details modal and populate the details
function openDetailsModal(bookingId) {
    detailsModal.style.display = "block";

    // Fetch booking details from the server
    fetch("fetch_checkin.php?booking_id=" + bookingId)
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            bookingDetails.innerHTML = data;
        })
        .catch(function(error) {
            console.log("Error fetching booking details: ", error);
        });
}


        // Function to close the booking details modal
        function closeDetailsModal() {
            detailsModal.style.display = "none";
        }

        // Attach event listeners to the view buttons
        for (var i = 0; i < viewButtons.length; i++) {
            viewButtons[i].addEventListener("click", function() {
                var bookingId = this.dataset.bookingId;
                openDetailsModal(bookingId);
            });
        }

        // Close modal when close button is clicked
        closeButton.addEventListener("click", closeDetailsModal);

        // Close modal when clicked outside the modal content
        window.addEventListener("click", function(event) {
            if (event.target === detailsModal) {
                closeDetailsModal();
            }
        });

  
// Function to get query parameter from URL
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

document.addEventListener("click", function(event) {
    if (event.target.classList.contains("edit-btn")) {
        var bookingId = event.target.getAttribute("data-booking-id");
        if (bookingId) {
            window.location.href = "edit_booking.php?booking_id=" + bookingId;
        }
    }
});

  // Function to confirm deletion when clicking the "Delete" button
  function confirmDelete(bookingOrderId) {
        var confirmMessage = "Are you sure you want to delete?";
        if (confirm(confirmMessage)) {
            // Redirect to the delete URL
            window.location.href = "check_in.php?delete=" + bookingOrderId;
        }
    }
    </script>
</body>
</html>
