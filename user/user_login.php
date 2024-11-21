<?php

include "connection.php"; // Ensure this initializes $db as a valid MySQL connection
include "navbar.php";

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style type="text/css">
    section {
      margin-top: -20px;
    }
    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 10px;
      text-align: center;
    }
    .success-message {
      color: green;
      font-size: 14px;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <section>
    <div class="log_img" style="background-image: url(image3.jpg);">
      <br><br>
      <div class="box1">
        <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console; color: antiquewhite;">
          Library Management System
        </h1>
        <h1 style="text-align: center; font-size: 25px; color: antiquewhite;">Login Form</h1><br>

        <!-- Login Form -->
        <form name="login" action="" method="post">
          <div class="login">
            <input type="text" name="username" placeholder="Username" required style="color:black;"><br><br>
            <input type="password" name="password" placeholder="Password" required style="color:black;"><br><br>
            <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px">
          </div>
        </form>

        <!-- Message Display -->
        <?php
        if (isset($_POST['submit'])) {
            // Initialize message variables
            $error_message = '';
            $success_message = '';

            // Sanitize inputs
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            // Use prepared statements to prevent SQL injection
            $query = $db->prepare("SELECT * FROM user WHERE username = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $row['password'])) {
                    $_SESSION['login_user'] = $username;
                    $success_message = "Login successful! Redirecting...";

                    // Redirect to the index page
                    echo "<script type='text/javascript'>window.location = 'index.php';</script>";
                } else {
                    $error_message = "Incorrect password. Please try again.";
                }
            } else {
                $error_message = "Username does not exist. Please check your username.";
            }

            // Display messages
            if (!empty($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            if (!empty($success_message)) {
                echo '<div class="success-message">' . $success_message . '</div>';
            }

            // Close the statement and connection
            $query->close();
            $db->close();
        }
        ?>
        <p style="color: white; padding-left: 15px;">
          <br><br><br>
          <a style="color: black;" href="">Forgot password?</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          New to this website? <a style="color: black;" href="registration.php">Sign Up</a>
        </p>
      </div>
    </div>
  </section>
</body>

</html>