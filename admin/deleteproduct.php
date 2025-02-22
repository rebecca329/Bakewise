<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $conn = new mysqli('localhost', 'root', '', 'bakewise');

    $delete_sql = "DELETE FROM products WHERE id = $product_id";
    
    if ($conn->query($delete_sql)) {
        header("Location: products.php");  
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
