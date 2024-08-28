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
$event_id = isset($_POST['event_id']) ? $conn->real_escape_string($_POST['event_id']) : '';
$description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : '';

// Prepare and execute the SQL query
$sql = "INSERT INTO events (event_id, description) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $event_id, $description);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Event added successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to add event. Please try again.';
}

// Close the connection
$stmt->close();
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
