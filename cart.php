<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }


    $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $product_quantity,
    ];

    echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add product']);
}
?>
