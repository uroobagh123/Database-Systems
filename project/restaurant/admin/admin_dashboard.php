<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['user_type']=="admin"){
       
    } if($_SESSION['user_type']=="user"){
        echo "go for user dashbaord";
    }
} else{
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>admin_dashboard</title>
        <style type="text/css">
            *{
                padding: 0;
                margin: 0;
            }
            .header{
                padding: 30px;
                background-color: black;
                color: white;
                text-align: right;
            }
            .header a{
                text-decoration: none;
                color: white;
                padding: 30px;
                background-color: red;
            }
            .sidebar{
                background-color: black;
                color: white;
                position: fixed;
                top: 0;
                height: 100%;
                width: 20%;
                border: 1px solid blue;
                text-align: center;
            }
            .sidebar a{
                text-decoration: none;
                display: block;
                padding: 30px 10px; 
                margin: 0;
                color: white;
            }
            .sidebar a:hover{
                background-color: blue;
            }
            .main{
                margin-left: 300px;
                margin-top: 20px;
            }
        </style>
    </head>
<body>
    <div class="div">
        <div class="header">
            <a href="../logout.php">log out</a>
        </div>
        <div class="main">
            <p>Hello Admin! You have full access to manage the restaurant system.</p>
        </div>
        <div class="sidebar">
            <a href="admin_dashboard.php">admin dashboard</a>
            <a href="add_items.php">add menu items</a>
            <a href="view_items.php">view menu items</a>
        </div>
</body>
</html>