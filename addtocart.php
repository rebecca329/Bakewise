<?php
session_start();
include 'db.php'; // Connection to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $productName = $_POST['product_name'];
    $productPrice = floatval($_POST['product_price']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Check if product exists in the database
    $query = "SELECT * FROM cart WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if product exists
        $updateQuery = "UPDATE cart SET quantity = quantity + ? WHERE product_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $quantity, $productId);
        $updateStmt->execute();
    } else {
        // Insert new product
        $insertQuery = "INSERT INTO cart (product_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("isdi", $productId, $productName, $productPrice, $quantity);
        $insertStmt->execute();
    }

    // Redirect to cart page
    header('Location: cart.php');
    exit();
} else {
    http_response_code(400);
    echo "Invalid request.";
    exit();
}
?>
