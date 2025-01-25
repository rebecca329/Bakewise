<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from the database
    $conn = new mysqli('localhost', 'root', '', 'admin');

    $delete_sql = "DELETE FROM productsss WHERE id = $product_id";
    
    if ($conn->query($delete_sql)) {
        header("Location: products.php");  // Redirect back to the products page
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
