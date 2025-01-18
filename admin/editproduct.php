<?php
// Fetch the product details for editing
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'admin');

    
    $sql = "SELECT * FROM productsss WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the product in the database
    $name = $_POST['name'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'] ?? NULL;
    $discount_percentage = $_POST['discount_percentage'] ?? NULL;
    $image_path = $_POST['image_path'] ?? NULL;
    $category_id = $_POST['category_id'];

    $update_sql = "UPDATE products SET name='$name', price='$price', original_price='$original_price', discount_percentage='$discount_percentage', image_path='$image_path', category_id='$category_id' WHERE id = $product_id";
    
    if ($conn->query($update_sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<form action="" method="POST">
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="<?= $product['name'] ?>" required><br><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?= $product['price'] ?>" required><br><br>

    <label for="original_price">Original Price:</label>
    <input type="number" step="0.01" id="original_price" name="original_price" value="<?= $product['original_price'] ?>"><br><br>

    <label for="discount_percentage">Discount Percentage:</label>
    <input type="number" id="discount_percentage" name="discount_percentage" value="<?= $product['discount_percentage'] ?>"><br><br>

    <label for="image_path">Image Path:</label>
    <input type="text" id="image_path" name="image_path" value="<?= $product['image_path'] ?>"><br><br>

    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <?php
        $category_result = $conn->query("SELECT id, name FROM categories");
        while ($row = $category_result->fetch_assoc()) {
            $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Update Product">
</form>
