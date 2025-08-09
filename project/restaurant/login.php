<?php
include "db.php";  // Include your database connection

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to find the user with the provided email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<h1 style='position: fixed; left:40%; top: 25%; color:red;'>Server error. Try again later</h1>";
    } else {
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $password) {
                session_start();  // Start session

                // Store user data in session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_type'] = $row['type'];

                // Redirect to the appropriate dashboard based on user type
                if ($_SESSION['user_type'] == "admin") {
                    header("Location: admin/admin_dashboard.php");
                } elseif ($_SESSION['user_type'] == "user") {
                    header("Location: user_dashboard.php");
                }
                exit;
            } else {
                echo "<h1 style='position: fixed; left:40%; top: 25%; color:red;'>Incorrect password</h1>";
            }
        } else {
            echo "<h1 style='position: fixed; left:40%; top: 25%; color:red;'>Email not found</h1>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Login</title>
    <style type="text/css">
        .form {
            position: fixed;
            top: 35%;
            left: 40%;
            padding: 30px;
            background-color: lightblue;
        }
        .form input {
            display: block;
            padding: 10px;
            margin: 5px;
            background-color: lightcoral;
        }
        .loginbutton {
            background-color: blue !important;
            color: white;
            width: 100%;
        }
    </style>
</head>
<body>
    <form class="form" action="login.php" method="post">
        Enter your email:<input type="email" name="email" required>
        Enter your password:<input type="password" name="password" required>
        <input class="loginbutton" type="submit" name="submit" value="Login">
        <p>Go for registration: <a href="register.php">Register</a></p>
    </form>
</body>
</html>
