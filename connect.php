<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bakewise"; // Fixed variable name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
