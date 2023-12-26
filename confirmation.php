<?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
      margin-top:150px;
    }

    h1 {
      font-size: 3.5rem;
      color: #444;
      margin-bottom: 3rem;
      text-transform: uppercase;
      text-align: center;
    }

    .confirmation-message {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .confirmation-message p {
      font-size: 2.2rem;
      margin-bottom: 1.5rem;
    }

    .ok-button {
      text-align: center;
      margin-top: 20px;
    }

    .ok-button button {
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      background-color: #3e80c2;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .ok-button button:hover {
      background-color: #2c5e9e;
    }
  </style>
</head>
<body>
  <h1>Booking Confirmation</h1>

  <div class="confirmation-message">
    <p>Thank you for your booking!</p>
    <p>Your booking has been confirmed.</p>
  </div>

  <div class="ok-button">
    <button onclick="redirectToBookingHistory()">OK</button>
  </div>

  <script>
    function redirectToBookingHistory() {
      window.location.href = "booking_history.php";
    }
  </script>
</body>
</html>
