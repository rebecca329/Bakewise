<?php
session_start();
include 'pdatabase.php';  

if (!isset($_SESSION['user_id'])) {
   
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];  
if (isset($_GET['action']) && isset($_GET['productId'])) {
    $action = $_GET['action'];
    $productId = (int) $_GET['productId'];

    if ($action == 'add') {
    
        $sql_check = "SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $user_id, $productId);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 0) {
            // Add the product to the wishlist in the database
            $sql_add = "INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)";
            $stmt_add = $conn->prepare($sql_add);
            $stmt_add->bind_param("ii", $user_id, $productId);
            $stmt_add->execute();

            $response = ['success' => true, 'message' => 'Product added to wishlist!'];
        } else {
            $response = ['success' => false, 'message' => 'Product is already in the wishlist.'];
        }
    } elseif ($action == 'remove') {
        // Remove the product from the wishlist in the database
        $sql_remove = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
        $stmt_remove = $conn->prepare($sql_remove);
        $stmt_remove->bind_param("ii", $user_id, $productId);
        $stmt_remove->execute();

        $response = ['success' => true, 'message' => 'Product removed from wishlist!'];
    }

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
        .wishlist .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }

        .wishlist .box {
            width: 300px;
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
            transform: scale(1.05); 
        }

        .wishlist .box .image img {
            max-width: 100%;  
            height: auto;    
            border-radius: 8px;  
        }

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
            color: #ff4081; 
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
        // Retrieve the user's wishlist from the database
        $sql = "SELECT p.id, p.name, p.image, p.price 
                FROM products p
                INNER JOIN wishlist w ON p.id = w.product_id
                WHERE w.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="box">
                    <div class="image">
                        <a href="productsdeet.php?id=' . $row["id"] . '">
                            <img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">
                        </a>
                        <div class="icons">
                            <button onclick="toggleWishlist(event, ' . $row["id"] . ')" class="fas fa-heart active"></button>
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
        ?>
        </div>
    </section>

    <script>
        function toggleWishlist(event, productId) {
            const action = event.target.classList.contains('active') ? 'remove' : 'add';

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
