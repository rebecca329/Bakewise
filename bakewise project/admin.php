<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create or Update Item
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // File upload logic
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target = "uploads/" . $image;

        // Ensure file is uploaded successfully
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            die("Error uploading the image.");
        }
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE items SET name=?, price=?, description=?, image=? WHERE id=?");
        $stmt->bind_param("sdssi", $name, $price, $description, $image, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO items (name, price, description, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $name, $price, $description, $image);
    }

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Delete Item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM items WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all items
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching items: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bakery Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bakery Items Management</h1>

    <!-- Add/Edit Form -->
    <form method="post" action="admin.php" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <label for="name">Item Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image">

        <button type="submit" name="save">Save</button>
    </form>

    <!-- Items List -->
    <h2>Items List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <?php
                            $imagePath = !empty($row['image']) ? "uploads/" . $row['image'] : "default-image.jpg";
                            echo "<img src='$imagePath' alt='Item Image' width='50'>";
                            ?>
                        </td>
                        <td>
                            <a href="javascript:editItem(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</a>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">No items found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        function editItem(item) {
            document.getElementById('id').value = item.id || '';
            document.getElementById('name').value = item.name || '';
            document.getElementById('price').value = item.price || '';
            document.getElementById('description').value = item.description || '';
        }
    </script>
</body>
</html>
