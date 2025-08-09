<?php
include "db.php";

if (isset($_POST['submit'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $type     = "user";
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO users(name, email, password, type, address, phone) 
            VALUES('$name', '$email', '$password', '$type', '$address', '$phone')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        if (mysqli_errno($conn) == 1062) {
            echo "<h1 style='margin-top: 5px; margin-left: 350px; color:red;'>⚠️ Email already registered. Please login or use another email.</h1>";
        } else {
            echo "<h1 style='margin-top: 5px; margin-left: 350px; color:red;'>❌ Server error. Please try again later.</h1>";
        }
    } else {
        echo "<h1 style='margin-top: 5px; margin-left: 350px; color:green;'>✅ Registered successfully. <a href='login.php'>Login here</a></h1>";
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>restaurant</title>
    <style type="text/css">
        .form {
            margin: 30px 300px;
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
        }
        .textarea {
            display: block;
            padding: 10px;
            margin: 5px;
            background-color: lightcoral;
            width: 80%;
            height: 100px;
        }
    </style>
</head>
<body>
    <form class="form" action="register.php" method="post">
        enter your name:<input type="text" name="name" required>
        enter your email:<input type="email" name="email" required>
        enter your password:<input type="password" name="password" required>
        enter your address:<textarea class="textarea" name="address"></textarea>
        enter your phone number:<input type="text" name="phone" required>
        <input class="loginbutton" type="submit" name="submit" value="signup">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>    
</body>
</html>
