
const SignUpButton = document.getElementById('SignUp'); 
const SignInButton = document.getElementById('SignIn'); 
const signInForm = document.getElementById('signIn'); 
const signUpForm = document.getElementById('signUp'); 


SignUpButton.addEventListener('click', function () {
    signInForm.style.display = "none"; 
    signUpForm.style.display = "block"; 
});


SignInButton.addEventListener('click', function () {
    signUpForm.style.display = "none"; 
    signInForm.style.display = "block";
});
