<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $productId = $_POST['product_id'];
        unset($_SESSION['cart'][$productId]);
    } elseif (isset($_POST['update'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                                <button type="submit" name="update">Update</button>
                            </form>
                        </td>
                        <td><?= $item['price'] * $item['quantity'] ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php $total += $item['price'] * $item['quantity']; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Total: $<?= $total ?></h2>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <a href="index.php">Continue Shopping</a>
</body>
</html>
