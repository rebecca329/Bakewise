<?php
session_start();
if (session_id() != "") { 
  
    session_destroy(); 
}

header("Location:adminlogin.php"); 
?>