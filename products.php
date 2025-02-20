<?php
session_start(); 
include 'pdatabase.php'; 

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - BakeWise</title>
    <link rel="stylesheet" href="styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <a href="#" class="logo">BakeWise<span>.</span></a>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="products.php">Products</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="icons">
            <a href="wishlist.php" class="fas fa-heart"></a>
            <a href="cart.html" class="fas fa-shopping-cart"></a>
            <a href="index.php" class="fas fa-user"></a>
        </div>
    </header>

    <section class="products" id="products">
        <div class="box-container">
        <?php
        $sql = "SELECT id, name, image, price FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               
                echo '
                <div class="box">
                    <div class="image">
                        <a href="productsdeet.php?id=' . $row['id'] . '">
                            <img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">
                        </a>
                        <div class="icons">
                            <!-- Wishlist icon with conditional active class -->
                            <a href="javascript:void(0);" class="fas fa-heart ' . (in_array($row['id'], $_SESSION['wishlist']) ? 'active' : '') . '" data-id="' . $row['id'] . '" onclick="toggleWishlist(' . $row['id'] . ')"></a>
                            
                            <a href="#" class="cart-btn" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '">Add to Cart</a>
                            <a href="productsdeet.php?id=' . $row['id'] . '" class="fas fa-info-circle"></a>
                        </div>
                    </div>
                    <div class="content">
                        <h3>' . $row['name'] . '</h3>
                        <div class="price">Rs.' . $row['price'] . '</div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
        </div>
    </section>

    <script>
       
        function toggleWishlist(productId) {
            const heartIcon = document.querySelector(`.fas.fa-heart[data-id='${productId}']`);
            const isInWishlist = heartIcon.classList.contains('active');
            const action = isInWishlist ? 'remove' : 'add';

           
            fetch(`wishlist.php?action=${action}&productId=${productId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (action === 'add') {
                        heartIcon.classList.add('active');
                        alert(data.message);
                    } else {
                        heartIcon.classList.remove('active');
                        alert(data.message);
                    }
                } else {
                    alert(data.message);
                }
            });
        }

        
        document.querySelectorAll(".cart-btn").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                const item = {
                    id: btn.dataset.id,
                    name: btn.dataset.name,
                    price: parseInt(btn.dataset.price),
                    quantity: 1,
                };
                const cart = JSON.parse(localStorage.getItem("cart")) || [];
                const existingItem = cart.find((cartItem) => cartItem.id === item.id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push(item);
                }
                localStorage.setItem("cart", JSON.stringify(cart));
                alert(`${item.name} added to the cart!`);
            });
        });
    </script>
</body>
</html>
