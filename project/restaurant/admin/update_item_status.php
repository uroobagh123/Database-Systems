<?php
session_start();
include "../db.php";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin") {
        if (isset($_POST['submit'])) {
            // Get order ID and new status from the form
            $order_id = $_POST['order_id'];  // FIXED
            $status = $_POST['status'];

            // Update the order status
            $sql = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "Error: {$conn->error}";
            } else {
                header("Location: view_order_items.php");
                exit();
            }
        }
    } elseif ($_SESSION['user_type'] == "user") {
        header("Location: ../user_dashboard.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
