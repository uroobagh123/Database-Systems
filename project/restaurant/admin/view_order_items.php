<?php
session_start();
include "../db.php";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin") {
        $sql = "SELECT users.id as user_id, users.name, users.email, users.address, users.phone, menu_items.id as item_id, menu_items.image, menu_items.name, menu_items.price, menu_items.category, orders.id, orders.status from orders join users on orders.customer_id=users.id join menu_items on orders.item_id=menu_items.id;";
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
            margin-left: 300px;
            margin-top: 20px;
            overflow-x: auto;
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
        .submitbtn{
            background-color: blue;
            color: white;
        } 
        .message{
            color: green;
            padding: 10px;
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
                    <th>customer id</th>
                    <th>customer name</th>
                    <th>customer email</th>
                    <th>customer address</th>
                    <th>customer phone</th>
                    <th>item id</th>
                    <th>item name</th>
                    <th>item image</th>
                    <th>item category</th>
                    <th>item price</th>
                    <th>order id</th>
                    <th>order status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['item_id']; ?></td>
                    <td><img style="width: 100px;" src="../image/<?php echo $row['image']; ?>"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><form class="" action="update_item_status.php" method="post">
                        <input type="text" name="order_id" value="<?php echo $row['id']; ?>"hidden>
                        <select style="padding: 10px; background-color: blue; color: white;" name="status">
                            <option value="pending">pending</option>
                            <option value="delivered">delivered</option>
                </select>
                <input style="color: white; background-color: blue; padding: 10px;" type="submit" name="submit" value="submit">
                </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
