<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];

    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'quantity' => 1
    ];

    // Check if the product is already in the cart
    $index = array_search($id, array_column($_SESSION['cart'], 'id'));

    if ($index !== false) {
        $_SESSION['cart'][$index]['quantity']++;
    } else {
        $_SESSION['cart'][] = $item;
    }
    header("Location: cart.php");
    exit();
}

if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['product_id'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($item) => $item['id'] != $id);
    header("Location: cart.php");
    exit();
}

$total = array_reduce($_SESSION['cart'], fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
<h1>Shopping Cart</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                    <button type="submit" name="remove_from_cart">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<h2>Total: <?= $total ?></h2>
<a href="i.php">Continue Shopping</a>
</body>
</html>
