<?php
session_start();
include 'pdatabase.php';  

// Check if wishlist session exists, if not, initialize it as an empty array
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Handle the CRUD operations based on the action parameter
if (isset($_GET['action']) && isset($_GET['productId'])) {
    $action = $_GET['action'];
    $productId = (int) $_GET['productId'];

    // Perform actions based on the 'action' parameter
    if ($action == 'add') {
        // Add item to the wishlist if not already added
        if (!in_array($productId, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'][] = $productId;
            $response = ['success' => true, 'message' => 'Product added to wishlist!'];
        } else {
            $response = ['success' => false, 'message' => 'Product is already in the wishlist.'];
        }
    } elseif ($action == 'remove') {
        // Remove item from wishlist
        if (($key = array_search($productId, $_SESSION['wishlist'])) !== false) {
            unset($_SESSION['wishlist'][$key]);
            $response = ['success' => true, 'message' => 'Product removed from wishlist!'];
        } else {
            $response = ['success' => false, 'message' => 'Product not found in the wishlist.'];
        }
    }

    // Return a JSON response with the result
    echo json_encode($response);
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - BakeWise</title>
    <style>
        /* Box container for the wishlist items */
        .wishlist .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }

        /* Styling for each product box */
        .wishlist .box {
            width: 300px; /* Limit the width of the box */
            box-sizing: border-box;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #fff;
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .wishlist .box:hover {
            transform: scale(1.05); /* Slight zoom effect on hover */
        }

        /* Ensure images are responsive and fit within the box */
        .wishlist .box .image img {
            max-width: 100%;  /* Limit image width to box width */
            height: auto;     /* Maintain aspect ratio */
            border-radius: 8px;  /* Optional: rounded corners for the images */
        }

        /* Product name and price styling */
        .wishlist .box .content {
            margin-top: 10px;
        }

        .wishlist .box .content h3 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .wishlist .box .content .price {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        /* Style for icons/buttons (e.g., heart icon) */
        .wishlist .box .icons {
            margin-top: 10px;
        }

        .wishlist .box .icons button {
            background: none;
            border: none;
            color: #pink; 
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .wishlist .box .icons button.active {
            color: #plum; 
        }

        .wishlist .box .icons button:hover {
            color: #ff4081; /* Hover effect */
        }
    </style>
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

    <section class="wishlist" id="wishlist">
        <h2>Your Wishlist</h2>
        <div class="box-container">
        <?php
        // Fetching all products from the database
        if (!empty($_SESSION['wishlist'])) {
            // Only proceed if the wishlist is not empty
            $sql = "SELECT id, name, image, price FROM products WHERE id IN (" . implode(',', $_SESSION['wishlist']) . ")";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="box">
                        <div class="image">
                            <a href="productsdeet.php?id=' . $row["id"] . '">
                                <img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">
                            </a>
                            <div class="icons">
                                <button onclick="toggleWishlist(event, ' . $row["id"] . ')" class="fas fa-heart ' . (in_array($row['id'], $_SESSION['wishlist']) ? 'active' : '') . '"></button>
                            </div>
                        </div>
                        <div class="content">
                            <h3>' . $row["name"] . '</h3>
                            <div class="price">Rs.' . $row["price"] . '</div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>Your wishlist is empty.</p>";
            }
        } else {
            echo "<p>Your wishlist is empty.</p>";
        }
        ?>
        </div>
    </section>

    <script>
        function toggleWishlist(event, productId) {
            const action = event.target.classList.contains('active') ? 'remove' : 'add';

            // Send a request to add/remove product from wishlist
            fetch(`wishlist.php?action=${action}&productId=${productId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (action === 'add') {
                        event.target.classList.add('active');
                        alert(data.message);
                    } else {
                        event.target.classList.remove('active');
                        alert(data.message);
                    }
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
</body>
</html>
