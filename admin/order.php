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
      :root {
    --pink: pink;
    --light-gray: #f9f9f9;
    --dark-gray: #333;
    --white: #fff;
    --red: #f76c6c;
    --red-hover: #e65b5b;
    --orange: orange;
    --green: green;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    text-decoration: none;
    text-transform: capitalize;
    transition: 0.2s linear;
}

body {
    line-height: 1.6;
    background: var(--light-gray);
    color: var(--dark-gray);
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: var(--white);
    padding: 2rem 9%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

header .logo {
    font-size: 3rem;
    color: var(--dark-gray);
    font-weight: bold;
}

header .logo span {
    color: var(--pink);
}

header nav a {
    font-size: 2rem;
    margin-left: 2rem;
    color: var(--dark-gray);
    transition: color 0.2s ease;
}

header nav a:hover {
    color: var(--pink);
}

section {
    padding: 5rem 9%;
    margin-top: 80px;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    background: var(--white);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    overflow: hidden;
}

.orders-table thead {
    background-color: var(--pink);
    color: var(--white);
    text-align: left;
}

.orders-table th, .orders-table td {
    padding: 12px;
    border: 1px solid #ddd;
}

.orders-table tr:nth-child(even) {
    background-color: var(--light-gray);
}

.orders-table td span {
    font-weight: bold;
}

.btn {
    padding: 8px 12px;
    background-color: var(--red);
    color: var(--white);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
}

.btn:hover {
    background-color: var(--red-hover);
}

.footer {
    background: #f3f3f3;
    padding: 3rem 9%;
    color: var(--dark-gray);
    text-align: center;
}

.footer .credit {
    font-size: 1.5rem;
    margin-top: 2rem;
    color: #555;
}

.footer .credit span {
    color: var(--pink);
}

@media (max-width: 991px) {
    html {
        font-size: 55%;
    }

    header {
        padding: 2rem;
    }

    section {
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    header nav {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    header nav a {
        margin: 10px 0;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }
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
                <td>Rs<?php echo $row['total_price']; ?></td>
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
