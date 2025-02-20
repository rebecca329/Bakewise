<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .box {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            width: 250px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin: 20px;
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

  
        .box .image {
            position: relative;
            overflow: hidden;
        }

        .box .image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .box:hover .image img {
            transform: scale(1.1);
        }

      
        .box .icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .box .icons a {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            text-decoration: none;
            font-size: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .box .icons a:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

       
        .box .content {
            padding: 15px;
        }

        .box .content h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .box .content .price {
            font-size: 1.2rem;
            color: #2d3748;
            font-weight: bold;
        }

    
        .cart-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 10px;
        }

        .cart-btn:hover {
            background-color: #45a049;
        }

       
        @media (max-width: 768px) {
            .box {
                width: 90%;
                margin: 15px auto;
            }
        }
    </style>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="product-container">
        <?php
       
        $conn = new mysqli('localhost', 'root', '', 'admin');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM productsss";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='box'>
                    <div class='image'>
                        <img src='{$row['image_path']}' alt='{$row['name']}'>
                    </div>
                    <div class='content'>
                        <h3>{$row['name']}</h3>
                        <div class='price'>Rs.{$row['price']}</div>
                    </div>
                    <div class='icons'>
                        <a href='#' class='fas fa-heart'></a>
                        <a href='#' class='cart-btn' data-id='{$row['id']}' data-name='{$row['name']}' data-price='{$row['price']}'>Add to Cart</a>
                        <a href='editproduct.php?id={$row['id']}' class='fas fa-edit'></a>
                        <a href='deleteproduct.php?id={$row['id']}' class='fas fa-trash'></a>
                    </div>
                </div>";
            }
        } else {
            echo "No products found";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
