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
$table_id = isset($_POST['table_id']) ? $conn->real_escape_string($_POST['table_id']) : '';
$table_position = isset($_POST['table_position']) ? $conn->real_escape_string($_POST['table_position']) : '';

// Prepare and execute the SQL query
$sql = "INSERT INTO table_list (table_id, table_position) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $table_id, $table_position);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Table added successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to add table. Please try again.';
}

// Close the connection
$stmt->close();
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
