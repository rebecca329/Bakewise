<?php
$conn = new mysqli('localhost', 'root', '', 'admin');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $conn->query("DELETE FROM productsss WHERE category_id=$id");

   
    $conn->query("DELETE FROM categories WHERE id=$id");
}


header("Location: categories.php");
exit();
?>
