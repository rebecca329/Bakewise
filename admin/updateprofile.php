<?php
session_start();

// Include database connection
include('dbconnection.php');

// Ensure the user is logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

// Handle profile update on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    // Update profile query
    $sql = "UPDATE users SET name = ?, email = ?, phone = ?, location = ? WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssi", $name, $email, $phone, $location, $_SESSION['user_id']);

        // Execute the query and check for success
        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
