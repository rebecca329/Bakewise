<?php
session_start();
if (!isset($_SESSION['adminEmail'])) {
    header("Location: adminLogin.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakeWise Admin Panel</title>
    
    <link rel="stylesheet" href="admin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

<section class="home" id="home">
    <div class="image">
        <img src="images/bg2.jpeg" alt="">
    </div>
    <div class="content">
        <h3>Welcome, Admin!</h3>
        <span>Manage your bakery efficiently</span>
        <p>Use the menu to access different sections of the admin panel.</p>
    </div>
</section>


<section class="dashboard" id="dashboard">
    <h2>Dashboard Overview</h2>
    <div class="stats">
        <div class="box">
            <h3>Total Products</h3>
            <p>150</p>
        </div>
        <div class="box">
            <h3>Orders Today</h3>
            <p>45</p>
        </div>
        <div class="box">
            <h3>Total Customers</h3>
            <p>320</p>
        </div>
        <div class="box">
            <h3>Monthly Revenue</h3>
            <p>12,500</p>
        </div>
    </div>
</section>

<section class="features" id="features">
    <h2>Key Features</h2>
    <div class="box-container">
        <div class="box">
            <i class="fas fa-box"></i>
            <h3>Manage Products</h3>
            <p>Add, edit, or remove products from the inventory.</p>
        </div>
        <div class="box">
            <i class="fas fa-tags"></i>
            <h3>Categories</h3>
            <p>Organize products into categories for easier browsing.</p>
        </div>
        <div class="box">
            <i class="fas fa-shopping-cart"></i>
            <h3>Order Management</h3>
            <p>View and update the status of customer orders.</p>
        </div>
        <div class="box">
            <i class="fas fa-chart-line"></i>
            <h3>Reports</h3>
            <p>Analyze sales and inventory trends.</p>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick Links</h3>
            <a href="dashboard.html">Dashboard</a>
            <a href="products.html">Products</a>
            <a href="categories.php">Categories</a>
        </div>
        <div class="box">
            <h3>Contact Info</h3>
            <a href="#">+977 9811111111</a>
            <a href="#">Bakewise@gmail.com</a>
            <a href="#">Pokhara, Nepal</a>
        </div>
    </div>
    <div class="credit">Created by <span>Team Shrek</span> | All rights reserved</div>
</footer>

</body>
</html>
