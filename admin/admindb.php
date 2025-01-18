<?php

$servername = "localhost";  
$username = "root";         
$password = "";            
$dbname = "admin"; 

// Establish a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch data for dynamic sections
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$products = $pdo->query("SELECT * FROM productsss")->fetchAll(PDO::FETCH_ASSOC);
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
    <input type="checkbox" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    <a href="#" class="logo">BakeWise<span>.</span></a>
    <nav class="navbar">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="products.php"><i class="fas fa-box"></i> Products</a>
        <a href="categories.php"><i class="fas fa-tags"></i> Categories</a>
        <a href="orders.php"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="customers.php"><i class="fas fa-users"></i> Customers</a>
        <a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    </nav>
</header>

<section class="home" id="home">
    <div class="image">
        <img src="images/bakery-background.jpeg" alt="Bakery Background">
    </div>
    <div class="content">
        <h3>Welcome, Admin!</h3>
        <span>Manage your bakery efficiently</span>
        <p>Use the menu to access different sections of the admin panel.</p>
    </div>
</section>

<section class="dashboard" id="dashboard">
    <h2>Product Categories</h2>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= htmlspecialchars($category['name']) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<script src="admin.js"></script>
</body>
</html>
