<?php
session_start();


include('dbconnection.php');


if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, phone, location FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone, $location);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<section class="update-profile">
    <h2>Update Profile</h2>
    <form action="updateprofile.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>" required>

        <button type="submit" class="submit-btn">Update Profile</button>
    </form>
</section>
</body>
</html>
