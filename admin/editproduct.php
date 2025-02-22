<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'bakewise');

    // Fetch existing product details
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'] ?? NULL;
    $discount_percentage = $_POST['discount_percentage'] ?? NULL;
    $category_id = $_POST['category_id'];

    // Handle image upload
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $imageTmpName = $_FILES['image_path']['tmp_name'];
        $imageName = $_FILES['image_path']['name'];
        $imageSize = $_FILES['image_path']['size'];
        $imageType = $_FILES['image_path']['type'];

        $targetDir = "uploads/";

        // Create the uploads directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); 
        }

        $targetFile = $targetDir . basename($imageName);

        // Check if file is a valid image
        if (getimagesize($imageTmpName) !== false) {
            // Move uploaded file to the target directory
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                $image_path = $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        } else {
            echo "File is not an image.";
            exit;
        }
    } else {
        // If no new image is uploaded, keep the old image path
        $image_path = $product['image_path'];
    }

    // Update the product details in the database
    $update_sql = "UPDATE products SET name='$name', price='$price', original_price='$original_price', discount_percentage='$discount_percentage', image_path='$image_path', category_id='$category_id' WHERE id = $product_id";

    if ($conn->query($update_sql)) {
        header("Location: products.php"); 
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="<?= $product['name'] ?>" required><br><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?= $product['price'] ?>" required><br><br>

    <label for="original_price">Original Price:</label>
    <input type="number" step="0.01" id="original_price" name="original_price" value="<?= $product['original_price'] ?>"><br><br>

    <label for="discount_percentage">Discount Percentage:</label>
    <input type="number" id="discount_percentage" name="discount_percentage" value="<?= $product['discount_percentage'] ?>"><br><br>

    <div class="form-group">
        <label for="image_path">Choose an Image:</label>
        <input type="file" id="image_path" name="image_path" accept="image/*">
        <?php if ($product['image_path']): ?>
            <br><br>
            <img src="<?= $product['image_path'] ?>" alt="Product Image" style="width: 100px; height: 100px;">
        <?php endif; ?>
    </div>

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
