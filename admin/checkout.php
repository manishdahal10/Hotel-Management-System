<?php
ob_start();
include "dashboard.php";
include "connect.php"; 

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$checkouts = [];

try {
    // Query for retrieving checkout records with user information
    $sql_checkouts = "SELECT co.*, u.phone, u.address 
                      FROM checked_out AS co
                      LEFT JOIN users AS u ON co.user_id = u.user_id
                      WHERE co.guest_name LIKE '%$keyword%' OR co.checkin_date LIKE '%$keyword%' OR co.checkout_date LIKE '%$keyword%'";
    $res_checkouts = $conn->query($sql_checkouts);
    
    if ($res_checkouts->num_rows > 0) {
        while ($row = $res_checkouts->fetch_assoc()) {
            $checkouts[] = $row;
        }
    }
} catch (Exception $e) {
    die('Database Error: ' . $e->getMessage());
}
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
       
        h1 {
            text-align: center;
            color: #444;
            padding: 20px;
            background-color: #fff;
            padding-top: 100px;
        }

       

        table {
            margin-left: 280px;
            width: 75%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #f00;
        }
    </style>
</head>
<body>
<h1>Checkout History</h1>

<div class="table-check">
    <!-- Display table -->
    <table border="1">
    <thead>
        <tr>
            <th>Checkout ID</th>
            <th>Guest Name</th>
            <th>Checkin Date</th>
            <th>Checkout Date</th>
            <th>Address</th>
            <th>Phone</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any records
        if (!empty($checkouts)) {
            foreach ($checkouts as $row) {
                echo "<tr>";
                echo "<td>" . $row['booking_order_id'] . "</td>";
                echo "<td>" . $row['guest_name'] . "</td>";
                echo "<td>" . $row['checkin_date'] . "</td>";
                echo "<td>" . $row['checkout_date'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                // Add more columns as needed
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found.</td></tr>";
        }
        ?>
    </tbody>
    </table>
</div>
</body>
</html>
