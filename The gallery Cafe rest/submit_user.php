<?php
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "gallery_restaurant"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'];
$user_name = $data['user_name'];
$user_email = $data['user_email'];
$user_password = $data['user_password'];
$mobile_number = $data['mobile_number'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO new_user (user_id, user_name, user_email, user_password, mobile_number) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $user_id, $user_name, $user_email, $user_password, $mobile_number);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>