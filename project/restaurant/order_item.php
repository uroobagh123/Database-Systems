<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Redirect admin users to admin dashboard
if ($_SESSION['user_type'] === "admin") {
    header("Location: admin/admin_dashboard.php");
    exit();
}

// Check if user is normal user and parameters are set
if ($_SESSION['user_type'] === "user") {
    if (isset($_GET['user_id']) && isset($_GET['menu_id'])) {
        $user_id = $_GET['user_id'];
        $item_id = $_GET['menu_id'];
        $status = "pending";

        // Insert order into database
        $sql = "INSERT INTO orders (customer_id, item_id, status) VALUES ('$user_id', '$item_id', '$status')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error: " . $conn->error;
        } else {
            $message = "Order added successfully";
            header("Location: index.php?added_message=" . urlencode($message));
            exit();
        }
    } else {
        echo "Invalid request. Missing item or user ID.";
    }
}
?>
