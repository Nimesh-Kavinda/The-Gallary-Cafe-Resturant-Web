<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$meal_id = isset($_POST['meal_id']) ? $conn->real_escape_string($_POST['meal_id']) : '';
$meal_name = isset($_POST['meal_name']) ? $conn->real_escape_string($_POST['meal_name']) : '';
$meal_type = isset($_POST['meal_type']) ? $conn->real_escape_string($_POST['meal_type']) : '';
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$item_id = isset($_POST['item_id']) ? $conn->real_escape_string($_POST['item_id']) : '';

// Prepare and execute the SQL query
$sql = "INSERT INTO menu_item (meal_id, meal_name, meal_type, price, item_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $meal_id, $meal_name, $meal_type, $price, $item_id);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Meal added successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to add meal. Please try again.';
}

// Close the connection
$stmt->close();
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
