<?php
session_start();
include 'dbconnection.php';

if (!isset($_GET['order_id'])) {
    echo "Order ID is required.";
    exit;
}

$order_id = $_GET['order_id'];

// Fetch order details from the database
$sql_order = "SELECT * FROM orders WHERE id = ?";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("i", $order_id);
$stmt_order->execute();
$order_result = $stmt_order->get_result();

if ($order_result->num_rows > 0) {
    $order = $order_result->fetch_assoc();
    $user_id = $order['user_id'];
    $total_amount = $order['total_amount'];
    
    $sql_order_items = "SELECT oi.*, p.name, p.image FROM order_items oi
                        INNER JOIN products p ON oi.product_id = p.id
                        WHERE oi.order_id = ?";
    $stmt_order_items = $conn->prepare($sql_order_items);
    $stmt_order_items->bind_param("i", $order_id);
    $stmt_order_items->execute();
    $order_items_result = $stmt_order_items->get_result();
    
    echo "<h2>Order Confirmation</h2>";
    echo "<p>Thank you for your order! Your order number is: $order_id</p>";
    echo "<p>Total Amount: Rs. $total_amount</p>";
    
    echo "<h3>Order Items:</h3>";
    while ($item = $order_items_result->fetch_assoc()) {
        echo "<div class='order-item'>";
        echo "<img src='images/" . $item['image'] . "' alt='" . $item['name'] . "' />";
        echo "<p>" . $item['name'] . " x" . $item['quantity'] . "</p>";
        echo "<p>Rs. " . $item['subtotal'] . "</p>";
        echo "</div>";
    }
} else {
    echo "Order not found.";
}
?>
