<?php
session_start();

// Check if user is logged in and is of type 'user'
if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] !== "user") {
        // If not a user, redirect to appropriate dashboard
        if ($_SESSION['user_type'] === "admin") {
            header("Location: admin/admin_dashboard.php");
            exit();
        } else {
            header("Location: login.php");
            exit();
        }
    }
} else {
    // Not logged in, redirect to login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: black;
            color: white;
            padding: 20px;
            text-align: right;
        }

        .header a {
            color: white;
            background-color: red;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .header a:hover {
            background-color: darkred;
        }

        .sidebar {
            background-color: black;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 20%;
            padding-top: 60px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: blue;
        }

        .main {
            margin-left: 20%;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="logout.php">Log Out</a>
    </div>

    <div class="sidebar">
        <a href="user_dashboard.php">User Dashboard</a>
        <a href="view_orders.php">View Orders</a>
        <a href="index.php">Place Orders</a>
    </div>

    <div class="main">
        <h2>Welcome to the User Dashboard</h2>
        <p>This is your main area. </p>
    </div>

</body>
</html>
