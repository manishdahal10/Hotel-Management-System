<?php
 include "dashboard.php";
 ?>
 
 <!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        
        .adminmain {
            max-width: 800px;
            margin-left: 390px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .admin-dashboard h1 {
            font-size: 28px;
            color: #333333;
            margin-top:100px;
        }

        .admin-dashboard p {
            font-size: 18px;
            color: #666666;
            margin-top: 20px;
        }

        .admin-dashboard ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
           
        }

        .admin-dashboard ul li {
            margin-bottom: 10px;
            display: inline-block; 
        }

        .admin-dashboard ul li a {
            display: block;
            padding: 10px 20px;
            background-color: #428bca;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .admin-dashboard ul li a:hover {
            background-color: #357ebd;
        }
    </style>
</head>
<body>
    <div class="adminmain">
    <div class="admin-dashboard">
        <h1>Welcome, Admin!</h1>
        <p>This is the admin dashboard for hotel management. You have access to the following features:</p>
        <ul>
            <li><a href="booked.php">View Booked Rooms</a></li>
            <li><a href="check_in.php">View Check-in Details</a></li>
            <li><a href="checkout.php">View Check-Out Details</a></li>
            <li><a href="add_room.php">Add new Room Category</a></li>
            <li><a href="display_room.php">View All Rooms</a></li>
            <li><a href="users.php">View Users</a></li>
            <li><a href="add_user.php">Add user</a></li>
            <li><a href="setting.php">Change Settings</a></li>
        </ul>
    </div>
    <div>
</body>
</html>
