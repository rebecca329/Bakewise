<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bakewise</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">Bakewise</div>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero" id="home">
    <h1>Welcome to Bakewise</h1>
    <p>Freshly baked goods, just for you!</p>
    <button onclick="showSpecialOffer()">Explore Now</button>
  </section>

  <section class="products" id="products">
    <h2>Our Bestsellers</h2>
    <div class="product-grid">
      <div class="product-card">
        <img src="bread.jpg" alt="Artisan Bread">
        <h3>Artisan Bread</h3>
        <p>Rs.40</p>
      </div>
      <div class="product-card">
        <img src="cupcake.jpg" alt="Cupcake Delight">
        <h3>Cupcake Delight</h3>
        <p>Rs.60</p>
      </div>
    </div>
  </section>

  <footer>
    <p>© 2024 Bakewise. All Rights Reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
