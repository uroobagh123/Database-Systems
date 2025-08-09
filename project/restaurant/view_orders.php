<?php
session_start();
include "db.php";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "user") {
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT
                    users.id AS user_id,
                    users.name AS customer_name,
                    users.email,
                    users.address,
                    users.phone,
                    menu_items.id AS item_id,
                    menu_items.image,
                    menu_items.name AS item_name,
                    menu_items.category,
                    menu_items.price,
                    orders.id AS order_id,
                    orders.status
                FROM orders 
                JOIN users ON orders.customer_id = users.id
                JOIN menu_items ON orders.item_id = menu_items.id
                WHERE orders.customer_id = '$user_id'";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error: {$conn->error}";
            exit();
        }
    } elseif ($_SESSION['user_type'] == "admin") {
        header("Location: admin/admin_dashboard.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Orders</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .header {
            padding: 20px;
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
            left: 0;
            height: 100%;
            width: 20%;
            padding-top: 60px;
        }

        .sidebar a {
            text-decoration: none;
            display: block;
            padding: 20px;
            color: white;
        }

        .sidebar a:hover {
            background-color: blue;
        }

        .main {
            margin-left: 20%;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: blue;
            color: white;
        }

        tr:nth-child(odd) {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #d0d0d0;
        }

        img {
            width: 100px;
        }

        select, input[type="submit"] {
            padding: 5px;
        }

        .submitbtn {
            background-color: blue;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .submitbtn:hover {
            background-color: darkblue;
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
    </div>

    <div class="main">
        <h2>Your Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Order ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['item_id']; ?></td>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><img src="image/<?php echo $row['image']; ?>" alt="Item Image"></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
