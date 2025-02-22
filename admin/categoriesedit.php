<?php
$conn = new mysqli('localhost', 'root', '', 'bakewise');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM categories WHERE id=$id");
    $category = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $name = $_POST['category_name'];
    $description = $_POST['category_description'];

    $conn->query("UPDATE categories SET name='$name', description='$description' WHERE id=$id");

    header("Location: categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form method="POST">
        <label>Category Name:</label>
        <input type="text" name="category_name" value="<?= $category['name'] ?>" required>
        
        <label>Category Description:</label>
        <textarea name="category_description" required><?= $category['description'] ?></textarea>
        
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
