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
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
        </form>
        <p class="or">--------------or--------------</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="button-group">
            <button type="submit">Register</button>
        </div>
        <div class="links">
            <p>Already Have an Account?</p>
            <a href="#">Login</a>
        </div>
    </div>
    <div class="container" id="login">
        <h1 class="form-title">Login</h1>
        <form method="post" action="">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <p class="recover">
                <a href="#">Recover Password</a></p>
        </form>
        <p class="or">--------------or--------------</p>
        <div class="links">
            <p>Don't have account?</p>
           <button id="LoginButton">Login</button>
        </div>
    </div>
    <script src="script.js"></script>

</body>
</html>
