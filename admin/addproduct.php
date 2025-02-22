<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'] ?? NULL;
    $discount_percentage = $_POST['discount_percentage'] ?? NULL;
    $category_id = $_POST['category_id'];

    
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $imageTmpName = $_FILES['image_path']['tmp_name'];
        $imageName = $_FILES['image_path']['name'];
        $imageSize = $_FILES['image_path']['size'];
        $imageType = $_FILES['image_path']['type'];

       
        $targetDir = "uploads/";
        
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); 
        }

        $targetFile = $targetDir . basename($imageName);

       
        if (getimagesize($imageTmpName) !== false) {
           
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                
                $conn = new mysqli('localhost', 'root', '', 'bakewise');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
                $stmt = $conn->prepare("INSERT INTO products (name, price, original_price, discount_percentage, image_path, category_id) VALUES (?, ?, ?, ?, ?, ?)");
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
