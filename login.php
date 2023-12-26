<?php
ob_start();
include("topnav.php");
?>
<?php
if (isset($_SESSION['username'])) {
    session_start();
    $_SESSION['username'] =  $_COOKIE['username'];
    $_SESSION['login_status'] = true;
    header('location:newroom.php');
}

$username = '';
if (isset($_POST['btnLogin'])) {
    $err  = [];
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        if (!preg_match("/^[a-zA-Z0-9_]{8,20}$/", $_POST['username'])) {
            $err['username'] =  'Enter valid username';
        } else {
            $username =  $_POST['username'];
        }
    } else {
        $err['username'] =  'Enter username';
    }

    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] =  'Enter password';
    }


    $conn = new mysqli("localhost", "root", "", "ho_tel");
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from users where username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            // if ($data['md5($_POST[password])'] === $password) {
            if ($data['password'] === $password) {
              
                header('location:newroom.php');
            } else {
                echo "<h2>invalid password</h2>";
            }

            if (isset($_POST['remember'])) {
                setcookie('username', $username, time() + 60);
            }
            session_start();
            $_SESSION['username'] =  $username;
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['login_status'] = true;
            header('location:newroom.php');
        } else {
            echo "<h2>invalid username</h2>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

<style>
      
      .error { 
         color: #ff0000;
         font-weight: 550;
     }
 
 
     .container{
     position: relative;
     margin-left: 500px;
     margin-top: 150px;
     max-width: 400px;
     width: 100%;
     background: #fff;
     padding: 40px 30px;
     box-shadow: 0 5px 10px rgba(0,0,0,0.2);
     
     }
 
 
     .container .cover .text{
     position: absolute;
     z-index: 130;
     height: 100%;
     width: 100%;
     display: flex;
     flex-direction: column;
     align-items: center;
     justify-content: center;
     }
     
     .container .forms{
     height: 100%;
     width: 100%;
     background: #fff;
     }
     .container .form-content{
     display: flex;
     align-items: center;
     justify-content: space-between;
     }
 
     .forms .form-content .title{
     position: relative;
     font-size: 24px;
     font-weight: 500;
     color: var(--primary);
     }
     .forms .form-content .title:before{
     content: '';
     position: absolute;
     left: 0;
     bottom: 0;
     height: 3px;
     width: 25px;
     background-color: var(--primary);
     }
 
     .forms .form-content .input-boxes{
     margin-top: 30px;
     justify-content: center;
     align-items: center;
     }
     .forms .form-content .input-box{
     display: flex;
     align-items: center;
     height: 50px;
     width: 100%;
     margin: 10px 0;
     position: relative;
     }
     .form-content .input-box input{
     height: 100%;
     width: 100%;
     outline: none;
     border: none;
     padding: 0 30px;
     font-size: 16px;
     font-weight: 500;
     border-bottom: 2px solid rgba(0,0,0,0.2);
     transition: all 0.3s ease;
     }
     
     .form-content .input-box i{
     position: absolute;
     color:var(--primary);
     font-size: 17px;
     }
     .forms .form-content .text{
     font-size: 14px;
     font-weight: 500;
     color: #333;
     }
     .forms .form-content .text a{
     text-decoration: none;
     }
     .forms .form-content .text a:hover{
     text-decoration: underline;
     }
     .forms .form-content .button{
     color: var(--primary);
     margin-top: 40px;
     }
     .forms .form-content .button input{
     color: #fff;
     background: var(--primary);;
     border-radius: 6px;
     padding: 0;
     cursor: pointer;
     transition: all 0.4s ease;
     }
     .forms .form-content .button input:hover{
     background: #5b13b9;
     }
     .forms .form-content label{
     color: #5b13b9;
     cursor: pointer;
     }
     .forms .form-content label:hover{
     text-decoration: underline;
     }
     .forms .form-content .login-text
     {
     text-align: center;
     margin-top: 25px;
     }
 
 
 </style>   
 
 <!-- HTML LOGIN  -->
 <body>
   <div class="container">
     <div class="cover">
     </div>
     <div class="forms">
         <div class="form-content">
           <div class="login-form">
             <div class="title">Login</div>
           <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
             <div class="input-boxes">
               <div class="input-box">
                 <i class="fa-sharp fa-solid fa-user"></i>
                 <input type="text" name="username" placeholder="Enter your username" />
                 <span class="error">
                 <?php echo (isset($err['username']) ? $err['username'] : ''); ?>
               </div>
               <div class="input-box">
                 <i class="fas fa-lock"></i>
                 <input type="password" name="password" placeholder="Enter your password" />
                 <span class="error">
                 <?php echo (isset($err['password']) ? $err['password'] : ''); ?>
                
               </div>
               
               <div class="button input-box">
                 <input type="submit"  name="btnLogin" value="Sign In">
               </div>
               <div class="text sign-up-text">Don't have an account? <a href="register.php">Register</a></div>
             </div>
         </form>
       </div>
       
     </div>
     </div>
   </div> 
</body>
<!-- <button value="Login" name="btnLogin" type="submit" >Login</button> -->


</html>