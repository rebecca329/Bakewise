<?php
session_start();


include('dbconnection.php');


if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

   
    $sql = "UPDATE users SET name = ?, email = ?, phone = ?, location = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssssi", $name, $email, $phone, $location, $_SESSION['user_id']);

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

      
        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    $conn->close();
}
?>
