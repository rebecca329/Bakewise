<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'] ?? NULL;
    $discount_percentage = $_POST['discount_percentage'] ?? NULL;
    $category_id = $_POST['category_id'];

    // Handle file upload
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $imageTmpName = $_FILES['image_path']['tmp_name'];
        $imageName = $_FILES['image_path']['name'];
        $imageSize = $_FILES['image_path']['size'];
        $imageType = $_FILES['image_path']['type'];

        // Define the target directory to save the image
        $targetDir = "uploads/";
        
        // Check if the directory exists; if not, create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create directory with proper permissions
        }

        $targetFile = $targetDir . basename($imageName);

        // Check if the file is an image
        if (getimagesize($imageTmpName) !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                // Create a database connection
                $conn = new mysqli('localhost', 'root', '', 'admin');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert into the database
                $stmt = $conn->prepare("INSERT INTO productsss (name, price, original_price, discount_percentage, image_path, category_id) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sddisi", $name, $price, $original_price, $discount_percentage, $targetFile, $category_id);


                if ($stmt->execute()) {
                    echo "Product added successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file uploaded or error occurred.";
    }
}
?>
