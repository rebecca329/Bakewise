<div class="container" id="signIn" style="display: none;">
    <h1 class="form-title">Sign In</h1>
    <form method="post" action="register.php">
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
        <button onclick="showSignUp()">Sign Up</button> 
    </div>
</div>

<div class="container" id="signUp" style="display: none;">
    <h1 class="form-title">Register</h1>
    <form method="post" action="register.php">
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
        <button onclick="showSignIn()">Sign In</button> 
    </div>
</div>
