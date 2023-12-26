<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['username'])) {
  header("location: index.php");
  exit();
}

?>




<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8" />
    <title> Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
      /* Googlefont Poppins CDN Link */
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
          *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
          }
          .sidebar{
            position: fixed;
            height: 100%;
            width: 240px;
            background: #0A2558;
            transition: all 0.5s ease;
          }
          .sidebar.active{
            width: 60px;
          }
          .sidebar .logo-details{
            height: 80px;
            display: flex;
            align-items: center;
          }
          .sidebar .logo-details i{
            font-size: 28px;
            font-weight: 500;
            color: #fff;
            min-width: 60px;
            text-align: center
          }
          .sidebar .logo-details .logo_name{
            color: #fff;
            font-size: 24px;
            font-weight: 500;
          }
          .sidebar .nav-links{
            margin-top: 10px;
          }
          .sidebar .nav-links li{
            position: relative;
            list-style: none;
            height: 50px;
          }
          .sidebar .nav-links li a{
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
          }
          .sidebar .nav-links li a.active{
            background: #081D45;
          }
          .sidebar .nav-links li a:hover{
            background: #081D45;
          }
          .sidebar .nav-links li i{
            min-width: 60px;
            text-align: center;
            font-size: 18px;
            color: #fff;
          }
          .sidebar .nav-links li a .links_name{
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
          }
          .sidebar .nav-links .log_out{
            position: absolute;
            bottom: 0;
            width: 100%;
          }
          .home-section{
            position: relative;
            background: #f5f5f5;
            /* min-height: 100vh; */
            width: calc(100% - 240px);
            left: 240px;
            transition: all 0.5s ease;
          }
          .sidebar.active ~ .home-section{
            width: calc(100% - 60px);
            left: 60px;
          }
          .home-section nav{
            display: flex;
            justify-content: space-between;
            height: 80px;
            background: #fff;
            display: flex;
            align-items: center;
            position: fixed;
            width: calc(100% - 240px);
            left: 240px;
            z-index: 100;
            padding: 0 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
          }
          .sidebar.active ~ .home-section nav{
            left: 60px;
            width: calc(100% - 60px);
          }
          .home-section nav .sidebar-button{
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 500;
          }
          .sidebar .nav-links li a.active,
.sidebar .nav-links li a:hover {
  background: #081D45;
}
          nav .sidebar-button i{
            font-size: 35px;
            margin-right: 10px;
          }
          .home-section nav .search-box{
            position: relative;
            height: 50px;
            max-width: 300px;
            width: 100%;
            margin: 0 20px;
          }
          nav .search-box input{
            height: 100%;
            width: 100%;
            outline: none;
            background: #F5F6FA;
            border: 2px solid #EFEEF1;
            border-radius: 6px;
            font-size: 18px;
            padding: 0 15px;
          }
          nav .search-box .bx-search{
            position: absolute;
            height: 40px;
            width: 40px;
            background: #2697FF;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 4px;
            line-height: 40px;
            text-align: center;
            color: #fff;
            font-size: 22px;
            transition: all 0.4 ease;
          }




    </style>
</head>
  <body>
    <section>
    <div class="sidebar">
      <div class="logo-details">
      <i class='bx bxs-building'></i>
        <span class="logo_name">Admin</span>
      </div>
      
      <ul class="nav-links">
        <li>
          <a href="admin.php" <?php if ($current_page == 'admin.php') echo 'class="active"'; ?>>
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="users.php" <?php if ($current_page === 'users.php') echo 'class="active"'; ?> >
            <i class="bx bx-box"></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="display_room.php" <?php if ($current_page === 'display_room.php') echo 'class="active"'; ?>>
            <i class="bx bx-heart"></i>
            <span class="links_name">RoomCategory</span>
          </a>
        </li>
        <li>
          <a href="booked.php" <?php if ($current_page === 'booked.php') echo 'class="active"'; ?>>
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Booked</span>
          </a>
        </li>
        <li>
          <a href="check_in.php" <?php if ($current_page === 'check_in.php') echo 'class="active"'; ?>>
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">CheckIn</span>
          </a>
        </li>
        <li>
          <a href="checkout.php" <?php if ($current_page === 'checkout.php') echo 'class="active"'; ?>>
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Checkout_History</span>
          </a>
        </li>
        <li>
          <a href="setting.php" <?php if ($current_page === 'setting.php') echo 'class="active"'; ?>>
            <i class="bx bx-cog"></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <!-- <i class="bx bx-menu sidebarBtn"></i> -->
          <span class="dashboard">Hotel Management System</span>
        </div>
        <div class="search-box">
        <form method="GET">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit"><i class="bx bx-search"></i></button>
    </form>
          <!-- <input type="text" placeholder="Search..." />
          <i class="bx bx-search"></i> -->
        </div>
       
      </nav>

      
    </section>
    
</body>
</html>
