<?php
// Fetching products from the database
$conn = new mysqli('localhost', 'root', '', 'admin');

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM productsss";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through the fetched products and display them
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='box'>
            <div class='image'>
                <img src='{$row['image_path']}' alt='{$row['name']}'>
                <div class='icons'>
                    <a href='#' class='fas fa-heart'></a>
                    <a href='#' class='cart-btn' data-id='{$row['id']}' data-name='{$row['name']}' data-price='{$row['price']}'>Add to Cart</a>
                    <a href='edit_product.php?id={$row['id']}' class='fas fa-edit'></a>
                    <a href='delete_product.php?id={$row['id']}' class='fas fa-trash'></a>
                </div>
            </div>
            <div class='content'>
                <h3>{$row['name']}</h3>
                <div class='price'>Rs.{$row['price']}</div>
            </div>
        </div>";
    }
} else {
    echo "No products found";
}

$conn->close();
?>
