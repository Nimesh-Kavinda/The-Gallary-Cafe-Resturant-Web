<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$item_id = $conn->real_escape_string($data['item_id']);
$customer_name = $conn->real_escape_string($data['customer_name']);
$mobile_number = $conn->real_escape_string($data['mobile_number']);

// Insert data into orders table
$sql = "INSERT INTO orders (item_id, customer_name, mobile_number) VALUES ('$item_id', '$customer_name', '$mobile_number')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
