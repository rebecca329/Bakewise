
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
function toggleForms() {
    const signIn = document.getElementById('signIn');
    const signUp = document.getElementById('signUp');
    
    if (signIn.style.display === 'none' && signUp.style.display === 'none') {
        signIn.style.display = 'block'; // Show login form by default
    } else {
        signIn.style.display = 'none';
        signUp.style.display = 'none';
    }
}

function showSignIn() {
    document.getElementById('signIn').style.display = 'block';
    document.getElementById('signUp').style.display = 'none';
}

function showSignUp() {
    document.getElementById('signIn').style.display = 'none';
    document.getElementById('signUp').style.display = 'block';
}
