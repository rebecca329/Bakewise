<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h1>Your Cart</h1><ul>";
    foreach ($_SESSION['cart'] as $id => $product) {
        echo "<li>{$product['name']} - Rs.{$product['price']} x {$product['quantity']}</li>";
    }
    echo "</ul>";
} else {
    echo "<h1>Your cart is empty</h1>";
}
?>
