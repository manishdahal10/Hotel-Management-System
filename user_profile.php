<?php
ob_start();
session_start();
@include 'config.php';
include 'topnav.php';

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect=user_profile.php"); // Redirect to the login page
    exit;
}

// Get the user ID
$userId = $_SESSION['user_id'];

// Retrieve the user's information from the database
$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $userId");
$userResult = mysqli_fetch_assoc($userQuery);



// Check if the form is submitted for changing the password
if (isset($_POST['changePassword'])) {
    // Retrieve the form data
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    // Check if the old password matches the current password in the database
    $checkPasswordQuery = mysqli_query($conn, "SELECT password FROM users WHERE  user_id = $userId");
    $passwordResult = mysqli_fetch_assoc($checkPasswordQuery);
    $currentPasswordHash = $passwordResult['password'];

    if (password_verify($oldPassword, $currentPasswordHash)) {
        // Update the password
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = mysqli_query($conn, "UPDATE users SET password = '$newHashedPassword' WHERE id = $userId");

        if ($updatePasswordQuery) {
            $successMessage = "Your password has been changed successfully.";
        } else {
            $errorMessage = "An error occurred while changing the password. Please try again.";
        }
    } else {
        $errorMessage = "The old password you entered is incorrect. Please try again.";
    }
}




// Check if the form is submitted for updating user information
if (isset($_POST['updateProfile'])) {
    // Retrieve the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];

    // Update the user's information in the database
    $updateQuery = mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email', address = '$address', gender = '$gender' WHERE id = $userId");

    if ($updateQuery) {
        // Update the session variables with the new user information
        // $_SESSION['username'] = $name;

        // Redirect to the profile page with a success message
        header("Location: user_profile.php?message=successfullychanged");
        exit();
    } else {
        // Display an error message
        $errorMessage = "An error occurred while updating the information. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            font-size: 3.5rem;
            color: #444;
            margin-bottom: 3rem;
            text-transform: uppercase;
            text-align: center;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            align-items: flex-start;
        }

        .profile-image {
            margin-top:90px;
            width: 350px;
            height: 300px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size:15px;
            border: 1px solid #ccc;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group .info {
            font-size: 14px;
            color: #666;
        }

        .form-group .success-message {
            color: green;
            margin-top: 10px;
        }

        .form-group .error-message {
            color: red;
            margin-top: 10px;
        }

        .form-group .btn-update {
            text-align: center;
            margin-top: 20px;
        }

        .form-group .btn-update button {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            background-color: #32CD32;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group .btn-update button:hover {
            background-color: #228B22;
        }

        .password-change {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .password-change .form-group {
            display: flex;
            align-items: center;
        }

        .password-change .form-group label {
            flex-basis: 150px;
        }

        .password-change .form-group input {
            flex: 1;
        }
    </style>
</head>
<body>
    <h1>User Profile</h1>

    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-image">
                <img src="images/userlogo.png" alt="User Image">
            </div>

            <div class="profile-details">
                <?php if (isset($successMessage)) { ?>
                    <div class="form-group success-message"><?php echo $successMessage; ?></div>
                <?php } ?>

                <?php if (isset($errorMessage)) { ?>
                    <div class="form-group error-message"><?php echo $errorMessage; ?></div>
                <?php } ?>

                <form method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $userResult['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $userResult['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo $userResult['address']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="Male" <?php if ($userResult['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($userResult['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                            <option value="Other" <?php if ($userResult['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>

                    
                    <div class="form-group btn-update">
                        <button type="submit" name="updateProfile">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="password-change">
            <h2>Change Password</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="oldPassword">Old Password:</label>
                    <input type="password" id="oldPassword" name="oldPassword">
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword">
                </div>

                <div class="form-group btn-update">
                    <button type="submit" name="changePassword">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>