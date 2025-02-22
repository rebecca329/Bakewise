<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakewise";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

// Insert each item into the 'cart' table
foreach ($data['cart'] as $item) {
    $product_id = $item['id'];
    $product_name = $item['name'];
    $product_price = $item['price'];
    $quantity = $item['quantity'];

    $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $product_id, $product_name, $product_price, $quantity);

    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error saving cart items']);
        exit;
    }
}

echo json_encode(['success' => true, 'message' => 'Cart items saved successfully']);
$conn->close();
?>
