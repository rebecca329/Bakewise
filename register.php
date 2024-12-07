<?php
include 'connect.php';
if(isset($_post['signUp'])){
    $firstName=$_post['fName'];
    $lastName=$_post['lNmae'];
    $email=$_post['email'];
    $password=$_post['password'];
    $password=md5($password);
    $checkEmail="SELECT * From user where email='$email'";
    $result=$conn_>query($checkEmail);
    $result->execute();
    $getresult= $result->getresult();
    
    If($getresult->num_rows>0){
        echo"Email Address Already Exists !";

    }
    else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)";
        VALUES ('$firstName','$lastName','$email','$password');
        if($conn->query($insertQuery)==TRUE){
            header("location: index.php");
            
        }
        else{
            echo"Error:".$conn->error;
        }


    }
    }
    if(isset($_POST['signIn'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password=md5($password);
        $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['emai']=$row['email'];
        header("Location:homepage.php");
        exit();
   }
   else{
    echo"Not Found, Incorrect Email or Password";

   }
   
        
    }
?>