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
    </header>

   
    <section class="add-product">
        <form action="addproduct.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="original_price">Original Price:</label>
                <input type="number" step="0.01" id="original_price" name="original_price">
            </div>

            <div class="form-group">
                <label for="discount_percentage">Discount Percentage:</label>
                <input type="number" id="discount_percentage" name="discount_percentage">
            </div>

            <div class="form-group">
                <label for="image_path">Choose an Image:</label>
                <input type="file" id="image_path" name="image_path" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    
                    <?php
                    
                    $conn = new mysqli('localhost', 'root', '', 'admin');
                    $result = $conn->query("SELECT id, name FROM categories");

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Add Product">
            </div>
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
