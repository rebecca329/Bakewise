<?php
$conn = new mysqli('localhost', 'root', '', 'admin');

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete related products first
    $conn->query("DELETE FROM productsss WHERE category_id=$id");

    // Now delete the category
    $conn->query("DELETE FROM categories WHERE id=$id");
}

// Redirect back to categories page
header("Location: categories.php");
exit();
?>
