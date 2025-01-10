<?php
$host = "localhost";
$user = "root";
$pass = ""; 

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database (if it exists)
$conn->select_db("bakewise"); 

// Execute the ALTER TABLE statement
$sql = "ALTER TABLE users
        ADD firstname VARCHAR(255),
        ADD lastname VARCHAR(255),
        ADD email VARCHAR(255);";

if ($conn->query($sql) === TRUE) {
    echo "Table altered successfully";
} else {
    echo "Error altering table: " . $conn->error;
}

$conn->close();
?>