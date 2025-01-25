<?php 
require 'dbconnection.php';

$order_id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $sql = "UPDATE orders SET status='$status' WHERE id=$order_id";
    if ($conn->query($sql)) {
        header('Location: order.php');
    }
}

$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
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

        /* Box Styling */
        .box {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Order Status</h1>
    <div class="box">
        <form method="POST">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="Pending" <?php echo $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Delivered" <?php echo $order['status'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                <option value="Canceled" <?php echo $order['status'] === 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
            </select>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
