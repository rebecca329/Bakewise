<?php
session_start(); // Start the session before trying to destroy it

if (session_id() != "") { 
    // Check if a session is actually active
    session_destroy(); 
}

header("Location: /bakewise/index.php"); 
?>