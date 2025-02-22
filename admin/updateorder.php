<?php
include "dbconnection.php"; 

if (!isset($_GET['id'])) {
    die("Order ID not found.");
}

$order_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = $_POST['status'];
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();
    header("Location: orders.php");
}

$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Order</title>
</head>
<body>
    <h1>Update Order #<?= $order_id ?></h1>
    <form method="post">
        <select name="status">
            <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Shipped" <?= $order['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
            <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
