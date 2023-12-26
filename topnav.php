<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hotel Website</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- swiper js cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
       <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');
    
    :root{
        --primary:#0077b6;
        --secondary:#48cae4;
        --black:#333;
        --white:#fff;
        --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
    }

    *{
        font-family: 'Poppins', sans-serif;
        margin: 0; padding: 0;
        box-sizing: border-box;
        outline: none; border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;
    }

    /* html{
        font-size: 62.5%;
        overflow-x: hidden;
        scroll-padding-top: 9rem;
        scroll-behavior: smooth;
    } */
    html {
  font-size: 50.5%;
  overflow-x: hidden;
  scroll-padding-top: 9rem;
        scroll-behavior: smooth;
}


    html::-webkit-scrollbar{
        width: .5rem;
    }

    html::-webkit-scrollbar-track{
        background: transparent;
    }

    html::-webkit-scrollbar-thumb{
        background: var(--primary);
        border-radius: .5rem;
    }

    section{
        padding: 5rem 7%;
    }

    .heading{
        font-size: 4.5rem;
        color: var(--primary);
        text-align: center;
        text-transform: uppercase;
        font-weight: bolder;
        margin-bottom: 3rem;
    }

    .btn{
        display: inline-block;
        margin-top: 1rem;
        padding: 1rem 3rem;
        background: var(--primary);
        border-radius: .5rem;
        color: var(--white);
        font-size: 1.7rem;
        cursor: pointer;
    }

    .btn:hover{
        background: var(--secondary);
    }

    /* header */

    .header{
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 1000;
        background: var(--white);
        box-shadow: var(--box-shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 2rem 9%;
    }

    .header .logo{
        font-size: 2.8rem;
        font-weight: bolder;
        color: var(--black);
    }

    .header .logo i{
        color: var(--primary);
        padding-right: .5rem;
    }

    .header .navbar a{
        font-size: 1.9rem;
        color: var(--black);
        margin: 0 1rem;
    }

    .header .navbar a:hover{
        color: var(--primary);
    }

    .header .navbar .btn{
        margin-top: 0;
        color: var(--white);
        font-size: 1.7rem;
        margin-left:2.8px;
    }

    .header .navbar .btn:hover{
        color: var(--white);
    }

    
    .btn-reg {
    background-color: var(--primary);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    }

    .btn-reg:hover {
    background-color: darkblue;
    }


    /* end */
    .dropdown {
  position: relative;
  display: inline-block;
}



.dropdown-content {
  display: none;
  position: absolute;
  min-width: 160px;
  padding: 8px;
  background-color: #fff;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}
.btn-user {
    background-color: var(--primary);
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    }

.dropdown-content a {
  display: block;
  padding: 8px 16px;
  font-size: 15px;
  /* color: #333; */
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: #f2f2f2;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>
</head>
<body>

   <!-- header -->

   <header class="header">

      <a href="index.php" class="logo"> <i class="fas fa-hotel"></i> Hotel Management System </a>

      <nav class="navbar">
         <a href="index.php">home</a>
         <a href="index.php#about">about</a>
         <a href="newroom.php">room</a>
         <a href="index.php#services">services</a>
         <a href="index.php#gallery">gallery</a>
       
      </nav>
      <div >
                
                    <!-- <a href="user_profile.php" class="btn-reg" onclick="openForm()"><i class="fa-solid fa-user"></i> My Profile</a>
                    <a href="user_logout.php" onclick="return confirm('are you sure you want to logout?')" class="btn-reg"><i class="fa-solid fa-right-to-bracket"></i>Logout</a> -->
                    <div class="dropdown">
  <?php
  if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  ?>
    <button class="btn-user"><i class="fa-solid fa-user"></i> <?php echo $username; ?>   <i class="fa-solid fa-caret-down"></i></button>
    <div class="dropdown-content">
      <a href="user_profile.php">Profile</a>
      <a href="booking_history.php">Bookings</a>
      <a href="user_logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout<i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    </div>
               <?php
                } else { ?>
                    <a href="login.php" class="btn-reg"><i class="fa-solid fa-user"></i>Sign In</a>
                    <a href="register.php" class="btn-reg">Register</a>
                <?php } ?>
            </div>
        </div>

   </header>
   <div id="menu-btn" class="fas fa-bars"></div>
 <!-- end -->

