<?php
session_start();
include "../db.php";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin") {
        $sql = "SELECT * FROM menu_items";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error: {$conn->error}";
            exit;
        }
    } elseif ($_SESSION['user_type'] == "user") {
        header("Location: ../user_dashboard.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            overflow-x: hidden;
        }
        .header {
            padding: 30px;
            background-color: black;
            color: white;
            text-align: right;
        }
        .header a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            background-color: red;
            border-radius: 5px;
        }
        .sidebar {
            background-color: black;
            color: white;
            position: fixed;
            top: 0;
            height: 100%;
            width: 20%;
            border-right: 1px solid blue;
            text-align: center;
            padding-top: 60px;
        }
        .sidebar a {
            text-decoration: none;
            display: block;
            padding: 20px 10px;
            color: white;
        }
        .sidebar a:hover {
            background-color: blue;
        }
        .main {
            margin-left: 20%;
            padding: 20px;
        }
        .main table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .main th {
            background-color: blue;
            color: white;
        }
        .main th, .main td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .main tr:nth-child(odd) {
            background-color: lightgray;
        }
        .main tr:nth-child(even) {
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="../logout.php">Log Out</a>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="add_items.php">Add Menu Items</a>
        <a href="view_items.php">View Menu Items</a>
        <a href="view_order_items.php">view orders</a>
    </div>

    <div class="main">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Item Category</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><img style="width: 100px;" src="../image/<?php echo $row['image']; ?>" alt="menu item image"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
