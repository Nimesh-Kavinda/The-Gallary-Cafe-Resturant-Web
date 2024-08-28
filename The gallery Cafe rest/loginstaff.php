<?php
header('Content-Type: application/json');

// Database credentials
$host = 'localhost';
$db = 'gallery_restaurant';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Get POST data
$member_name = $_POST['member_name'];
$password = $_POST['password'];

// Prepare SQL query
$sql = $conn->prepare('SELECT * FROM staff_member WHERE member_name = ? AND password = ?');
$sql->bind_param('ss', $member_name, $password);
$sql->execute();
$result = $sql->get_result();

// Check if credentials are correct
if ($result->num_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid member name or password']);
}

// Close connection
$sql->close();
$conn->close();
?>
