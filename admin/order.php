<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if your database username is different
$password = ""; // Add your database password
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - BakeWise Admin Panel</title>
    <link rel="stylesheet" href="admin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color:  pink;
            padding: 10px 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }
        header nav a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
            font-size: 16px;
        }
        .orders-table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            text-align: left;
        }
        .orders-table thead {
            background-color: pink;
            color: #fff;
        }
        .orders-table th, .orders-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .orders-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 8px 12px;
            background-color: #f76c6c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #e65b5b;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">BakeWise<span>.</span></div>
    <nav>
        <a href="dashboard.html">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="categories.html">Categories</a>
        <a href="order.php" class="active">Orders</a>
        <a href="customers.html">Customers</a>
        <a href="reports.html">Reports</a>
        <a href="settings.html">Settings</a>
    </nav>
</header>

<section>
    <h2 style="text-align: center; margin: 20px;">Manage Orders</h2>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>#<?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($row['product']); ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo $row['total_price']; ?></td>
                <td>
                    <span style="color: 
                        <?php echo ($row['status'] === 'Delivered' ? 'green' : ($row['status'] === 'Pending' ? 'orange' : 'red')); ?>;">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
                <td>
                    <a href="vieworder.php?id=<?php echo $row['id']; ?>" class="btn">View</a>
                    <a href="editorder.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<footer class="footer">
    <div class="credit" style="text-align: center; padding: 10px 0;">
        Created by <span>Team Shrek</span> | All rights reserved
    </div>
</footer>

</body>
</html>
