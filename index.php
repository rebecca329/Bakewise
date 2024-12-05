<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register and Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" id="signUp" style="display: none;">
    <h1 class="form-title">Register</h1>
    <form method="post" action="">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="fName" id="fName" placeholder="First Name" required>
            <label for="fName">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <input type="submit" class="btn" value="Sign Up" name="SignUp">
    </form>
    <p class="or">--- or ---</p>
    <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
        <p>Already have an account?</p>
        <button id="SignIn">Sign In</button> 
    </div>
</div>
  
<div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <form method="post" action="">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email-login" placeholder="Email" required>
            <label for="email-login">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password-login" placeholder="Password" required>
            <label for="password-login">Password</label>
        </div>
        <p class="recover">
            <a href="#" class="link">Recover Password</a>
        </p>
        <input type="submit" class="btn" value="Sign In" name="SignIn">
    </form>
    <p class="or">--- or ---</p>
    <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
        <p>Don't have an account yet?</p>
        <button id="SignUp">Sign Up</button> 
    </div>
</div>
    <script src="script.js"></script>
</body>
</html> -->

<?php
// Define an array of products
$products = [
    [
        "name" => "Brownie",
        "image" => "images/brownie.jpg",
        "price" => 150,
        "original_price" => 200,
        "discount" => "-5%",
        "currency" => "Rs."
    ],
    [
        "name" => "Lemon Cookie",
        "image" => "images/lemon.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ],
    [
        "name" => "Banana Bread",
        "image" => "images/banana.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ],
    [
        "name" => "Plain Bread",
        "image" => "images/pbread.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ],
    [
        "name" => "Chocolate Chip Cookie",
        "image" => "images/cookie.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ],
    [
        "name" => "Cinnamon Roll",
        "image" => "images/cinimon.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ],
    [
        "name" => "Vanilla Muffin",
        "image" => "images/muffine.jpg",
        "price" => 50,
        "original_price" => 150,
        "discount" => "-10%",
        "currency" => "Rs."
    ],
    [
        "name" => "Blueberry Muffin",
        "image" => "images/blue.jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-5%",
        "currency" => "$"
    ],
    [
        "name" => "Bagel",
        "image" => "images/bagals (2).jpg",
        "price" => 8.99,
        "original_price" => 10.99,
        "discount" => "-10%",
        "currency" => "$"
    ]
];
?>

<!-- Product Section -->
<section class="products" id="products">
    <h1 class="heading">Our <span>Products</span></h1>
    <div class="box-container">
        <?php foreach ($products as $product): ?>
            <div class="box">
                <span class="discount"><?= $product['discount'] ?></span>
                <div class="image">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Add to Cart</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3><?= $product['name'] ?></h3>
                    <div class="price">
                        <?= $product['currency'] . $product['price'] ?>
                        <span><?= $product['currency'] . $product['original_price'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<?php
// Initialize variables
$name = $email = $number = $message = "";
$nameErr = $emailErr = $numberErr = $messageErr = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    // Validate and sanitize email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Validate and sanitize number
    if (empty($_POST["number"])) {
        $numberErr = "Number is required";
    } elseif (!is_numeric($_POST["number"])) {
        $numberErr = "Invalid number format";
    } else {
        $number = htmlspecialchars($_POST["number"]);
    }

    // Validate and sanitize message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = htmlspecialchars($_POST["message"]);
    }

    // If no errors, process the form (e.g., save to database, send email, etc.)
    if (empty($nameErr) && empty($emailErr) && empty($numberErr) && empty($messageErr)) {
        // For simplicity, display a success message (You can replace this with database or email logic)
        $success = "Your message has been sent successfully!";
    }
}
?>




<!-- Contact Section -->
<section class="contact" id="contact">
    <h1 class="heading"><span>Contact</span> Us</h1>
    <div class="row">
        <!-- Contact Form -->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="text" name="name" placeholder="Name" class="box" value="<?= $name; ?>">
            <span class="error"><?= $nameErr; ?></span>
            <input type="email" name="email" placeholder="Email" class="box" value="<?= $email; ?>">
            <span class="error"><?= $emailErr; ?></span>
            <input type="text" name="number" placeholder="Number" class="box" value="<?= $number; ?>">
            <span class="error"><?= $numberErr; ?></span>
            <textarea name="message" class="box" placeholder="Message" cols="30" rows="10"><?= $message; ?></textarea>
            <span class="error"><?= $messageErr; ?></span>
            <input type="submit" value="Send Message" class="btn">
            <?php if ($success): ?>
                <p class="success"><?= $success; ?></p>
            <?php endif; ?>
        </form>

        <!-- Contact Image -->
        <div class="image">
            <img src="images/contact-img.svg" alt="Contact Us">
        </div>
    </div>
</section>

