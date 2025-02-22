<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakeWise Admin Panel - Categories</title>
    <style>
        
.categories-section {
    padding: 2rem;
    background-color: #f9f9f9;
}

.categories-section h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.category-form {
    background-color: #fff;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    width: 50%;
    margin: 0 auto;
}

.category-form label {
    font-size: 1rem;
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
}

.category-form input, 
.category-form textarea {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
}

.category-form textarea {
    resize: vertical;
    min-height: 100px;
}

.category-form button {
    background-color: #5cb85c;
    color: #fff;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.category-form button:hover {
    background-color: #4cae4c;
}

.categories-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 2rem;
}

.categories-table th, 
.categories-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.categories-table th {
    background-color: #f0f0f0;
    font-weight: bold;
    color: #333;
}

.categories-table td {
    background-color: #fff;
}

.categories-table a {
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9rem;
    margin-right: 0.5rem;
}

.categories-table .btn-edit {
    background-color: #ffc107;
    color: #fff;
}

.categories-table .btn-edit:hover {
    background-color: #e0a800;
}

.categories-table .btn-delete {
    background-color: #d9534f;
    color: #fff;
}

.categories-table .btn-delete:hover {
    background-color: #c9302c;
}


.footer {
    background-color: #333;
    color: #fff;
    padding: 2rem 0;
    margin-top: 2rem;
}

.footer .box-container {
    display: flex;
    justify-content: space-between;
    padding: 0 10%;
}

.footer .box {
    width: 45%;
}

.footer .box h3 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: #fff;
}

.footer .box a {
    color: #bbb;
    display: block;
    margin-bottom: 0.5rem;
    text-decoration: none;
    font-size: 0.9rem;
}

.footer .box a:hover {
    color: #fff;
}

.footer .credit {
    text-align: center;
    font-size: 0.8rem;
    color: #bbb;
    margin-top: 1rem;
}

.footer .credit span {
    color: #5cb85c;
}

    </style>
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
        <img src="images/bg2.jpeg" alt="Bakery Background">
    </div>
    <div class="content">
        <h3>Manage Categories</h3>
        <span>Organize products into categories</span>
        <p>Use the form below to add new categories or manage existing ones.</p>
    </div>
</section>

<section class="categories-section" id="categories-section">
    <h2>Category Management</h2>
    
    <form action="addcategory.php" method="POST" class="category-form">
        <label for="category_name">Category Name</label>
        <input type="text" id="category_name" name="category_name" required placeholder="Enter category name">
        
        <label for="category_description">Category Description</label>
        <textarea id="category_description" name="category_description" required placeholder="Enter category description"></textarea>
        
        <button type="submit" class="btn-add-category">Add Category</button>
    </form>
    
    <h3>Existing Categories</h3>
    <table class="categories-table">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           
            <?php
          
            $conn = new mysqli('localhost', 'root', '', 'admin');
            $result = $conn->query("SELECT id, name, description FROM categories");
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='categoriesedit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                            <a href='categoriesdel.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this category?');\">Delete</a>
                        </td>  
                      </tr>";
            }
            
            ?>
        </tbody>
    </table>
</section>

<footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick Links</h3>
            <a href="dashboard.html">Dashboard</a>
            <a href="products.html">Products</a>
            <a href="categories.html">Categories</a>
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
