<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];  // Assuming user_id is stored in session when logged in

// Fetch cart items from session (or database if needed)
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $cart_items = $_SESSION['cart'];
} else {
    $cart_items = [];  // No items in the cart
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cart_items)) {
    // Example of cart data: [product_id => quantity]
    $total_amount = 0;

    // Create an order record in the orders table
    $sql_order = "INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)";
    $stmt_order = $conn->prepare($sql_order);
    $status = 'Pending';  // Example status
    $stmt_order->bind_param("ids", $user_id, $total_amount, $status);
    $stmt_order->execute();
    $order_id = $stmt_order->insert_id;

    // Insert cart items into the order_items table
    foreach ($cart_items as $product_id => $quantity) {
        // Fetch product details from the database
        $sql_product = "SELECT name, price FROM products WHERE id = ?";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->bind_param("i", $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
    
        if ($result_product->num_rows > 0) {
            $product = $result_product->fetch_assoc();
            $product_name = $product['name'];
            $price = $product['price'];
            $subtotal = $price * $quantity;
    
            // Insert the item into the order_items table
            $sql_order_item = "INSERT INTO order_items (order_id, product_name, customer_name, quantity, total_price, status) 
                               VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_order_item = $conn->prepare($sql_order_item);
            $stmt_order_item->bind_param("issdss", $order_id, $product_name, $customer_name, $quantity, $subtotal, $status);
            $stmt_order_item->execute();
    
            // Update the total amount of the order
            $total_amount += $subtotal;
        }
    }
    

    // Update the total amount of the order
    $sql_update_order = "UPDATE orders SET total_amount = ? WHERE id = ?";
    $stmt_update_order = $conn->prepare($sql_update_order);
    $stmt_update_order->bind_param("di", $total_amount, $order_id);
    $stmt_update_order->execute();

    // Optionally, clear the cart after successful order
    unset($_SESSION['cart']);

    // Redirect to order confirmation page
    header("Location: orderconfirmation.php?order_id=" . $order_id);
    exit;
}

// Admin panel: Fetch existing orders for display
$result = $conn->query("SELECT orders.id, orders.customer_name, orders.product, orders.quantity, orders.total_price, orders.status FROM orders");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakeWise Admin Panel</title>
    
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

        
        body {
            line-height: 1.6;
            background: var(--light-gray);
            color: var(--dark-gray);
            font-size: 14px;
        }
        
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 1rem 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        section {
            padding: 3rem 7%;
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
            padding: 10px;
            border: 1px solid #ddd;
        }

        .orders-table tr:nth-child(even) {
            background-color: var(--light-gray);
        }

        .btn {
            padding: 8px 12px;
            background-color: var(--red);
            color: var(--white);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .footer {
            background: #f3f3f3;
            padding: 2rem 7%;
            color: var(--dark-gray);
            text-align: center;
        }
    </style>

</head>
<body>
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">BakeWise<span>.</span></a>
    <nav class="navbar">
        <a href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="products.php"><i class="fas fa-box"></i> Products</a>
        <a href="categories.php"><i class="fas fa-tags"></i> Categories</a>
        <a href="order.php"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="customers.html"><i class="fas fa-users"></i> Customers</a>
        <a href="reports.html"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="setting.html"><i class="fas fa-cogs"></i> Settings</a>
        <a href="profile.html"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
        <div class="credit">Created by <span>Team Shrek</span> | All rights reserved</div>
    </footer>

    <script>
    
        let cart = JSON.parse(localStorage.getItem("cart"));

        if (cart && cart.length > 0) {
            fetch("order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ cart: cart })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    localStorage.removeItem("cart");
                    window.location.href = "order.php";
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong!");
            });
        } else {
            alert("Cart is empty!");
        }
    </script>
</body>
</html>
