<?php
session_start();


include 'connect.php'; 

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SignIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if email exists
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" means string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, now verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password matches, login success
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.html'); // Redirect to dashboard or logged-in page
            exit;
        } else {
            // Password incorrect
            $error_message = "Invalid email or password.";
        }
    } else {
        // No user found with that email
        $error_message = "Invalid email or password.";
    }
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SignUp'])) {
    // Get form data for registration
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user into the database
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fName, $lName, $email, $hashed_password);
    $stmt->execute();

    header('Location: index.php'); // After successful registration, redirect to login page
    exit;
}
?>
<!DOCTYPE html>
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

    
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email-signup" placeholder="Email" required>
            <label for="email-signup">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password-signup" placeholder="Password" required>
            <label for="password-signup">Password</label>
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
        <button id="SignUp"><a href="register.php">Sign Up</a></button> 
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
