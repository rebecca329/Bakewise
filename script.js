const signUpButton=document.getElementById('signUpButton');
const signIpButton=document.getElementById('signInButton');
const signInForm=document.getElementById('signIn');
const signUpForm=document.getElementById('signUp');
signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";

})
signInForm.addEventListener('click',function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";

})


