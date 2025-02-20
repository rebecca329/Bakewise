<?php
// This file will handle the form submission and update the settings in the database

// Include database connection
include('db_connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    $notifications = $_POST['notifications'];

   
    if ($newPassword == $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE admins SET password = ?, email_notifications = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $hashedPassword, $notifications, $adminId);

      
        if ($stmt->execute()) {
            echo "Settings updated successfully!";
        } else {
            echo "Error updating settings.";
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>
