<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - BakeWise</title>
    <link rel="stylesheet" href="products.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

    <header>
        <input type="checkbox" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
    </header>

    <!-- Add Product Form -->
    <section class="add-product">
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required><br><br>

            <label for="original_price">Original Price:</label>
            <input type="number" step="0.01" id="original_price" name="original_price"><br><br>

            <label for="discount_percentage">Discount Percentage:</label>
            <input type="number" id="discount_percentage" name="discount_percentage"><br><br>

           <label for="image_path">Choose an Image:</label>
<input type="file" id="image_path" name="image_path" accept="image/*" required><br><br>


            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <!-- PHP code to fetch categories from the database -->
                <?php
                // Assuming you have a connection to the database, this PHP code fetches categories
                $conn = new mysqli('localhost', 'root', '', 'admin');
                $result = $conn->query("SELECT id, name FROM categories");
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select><br><br>

            <!-- <label for="product_select">Choose a Product:</label>
            <select id="product_select" name="product_select">
                <option value="brownie">Brownie</option>
                <option value="lemon_cookie">Lemon Cookie</option>
                <option value="banana_bread">Banana Bread</option>
                <option value="plain_bread">Plain Bread</option>
                <option value="chocolate_chip_cookie">Chocolate Chip Cookie</option>
            </select><br><br> -->
            <input type="submit" value="Add Product"><a href="addproduct.php"></a>

        </form>
    </section>

    <section class="products" id="products">
        <h2>Product List</h2>
        <div class="product-container">
            <?php include 'fetch_products.php'; ?>
        </div>
    </section>
</body>
</html>
