<?php
require 'dbconnection.php'; // Ensure this file exists and is correct

// Validate and sanitize the 'id' parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing order ID.");
}

$order_id = intval($_GET['id']); // Convert 'id' to an integer for security

// Fetch the order details from the database
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $order = $result->fetch_assoc(); // Fetch order details into the $order array
} else {
    die("Order not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Order</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Paragraph Styling */
        p {
            margin: 15px 0;
            font-size: 16px;
            color: #555;
        }

        p strong {
            color: #000;
        }

        /* Button Styling */
        a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
            cursor: pointer;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
        <p><strong>Product:</strong> <?php echo htmlspecialchars($order['product']); ?></p>
        <p><strong>Quantity:</strong> <?php echo $order['quantity']; ?></p>
        <p><strong>Total Price:</strong> Rs<?php echo $order['total_price']; ?></p>
        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
        <a href="order.php">Back to Orders</a>
    </div>
</body>
</html>
