<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $conn = new mysqli('localhost', 'root', '', 'admin');

    $delete_sql = "DELETE FROM productsss WHERE id = $product_id";
    
    if ($conn->query($delete_sql)) {
        header("Location: products.php");  
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
