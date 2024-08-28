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

// Retrieve event_id from POST request
$event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;

// Prepare and execute the SQL query
$sql = "DELETE FROM events WHERE event_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);

$response = array();

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Event removed successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Event ID not found.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to execute query.';
}

// Close the connection
$stmt->close();
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
