<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default quantity to 1 if not provided

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $quantity
        ];
    }

    // Redirect to cart page
    header('Location: cart.php');
    exit();
} else {
    // Handle invalid request (e.g., display an error message)
    http_response_code(400); // Bad Request
    echo "Invalid request.";
    exit();
}
?>