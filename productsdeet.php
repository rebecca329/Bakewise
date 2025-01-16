<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products- BakeWise</title>
    <link rel="stylesheet" href="styless.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <header>
        <input type="checkbox" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
    </header>
    <section id="product-details">
    <section class="products" id="products">
        <h1 class="heading">Products <span>details</span></h1>
        <div class="box-container">
        <div class="box">
                <div class="image">
                    <img src="images/brownie.jpg" alt="Brownie"> 
                </div>
                <div class="content">
                    <h3>Brownie</h3>
                    <h2 id="Brownie"></h2>
                <p id="product-description">A brownie is a rich, fudgy, and chocolatey baked treat with a soft, gooey center and a slightly crisp top.
                     Perfectly indulgent, it’s a bite-sized delight for chocolate lovers. </p>
                <div class="price">Rs.230 <span id="Rs.250"></span></div>
                
                <form action="addtocart.php" method="POST"> 
    <input type="hidden" name="product_id" value="PRODUCT_ID">
    <div class="quantity">
        <label for="quantity"><i class="fas fa-cogs"></i> Quantity:</label>
        <input type="number" id="quantity" min="1" value="1">
    </div>
    <a href="addtocart.php" class="addtocart" id="addtocart">
        <i class="fas fa-shopping-cart"></i> Add to Cart
    </a>
</form>
            </div>
                </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
