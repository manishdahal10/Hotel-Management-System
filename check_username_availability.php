<?php
// Retrieve the username from the AJAX request
$username = $_POST['username'];

// Connect to the MySQL database
$conn = new mysqli('localhost', 'root', '', 'ho_tel');

// Prepare the query to check if the username exists
$stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the result row
$row = $result->fetch_assoc();

// Return the availability status as JSON
$response = [
  'available' => ($row['count'] == 0)
];
echo json_encode($response);
?>

