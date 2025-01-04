<?php
include 'db.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
<h1>Products</h1>
<div>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h2><?= $row['name'] ?></h2>
            <p>Price: $<?= $row['price'] ?></p>
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="product_name" value="<?= $row['name'] ?>">
                <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    <?php endwhile; ?>
</div>
<a href="cart.php">Go to Cart</a>
</body>
</html>
