<?php
// Retrieve the email from the AJAX request
$email = $_POST['email'];

// Connect to the MySQL database
$conn = new mysqli('localhost', 'root', '', 'ho_tel');

// Prepare the query to check if the email exists
$stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
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
