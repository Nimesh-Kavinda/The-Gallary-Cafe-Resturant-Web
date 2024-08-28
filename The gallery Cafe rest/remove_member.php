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

// Retrieve member_id from POST request
$member_id = isset($_POST['member_id']) ? intval($_POST['member_id']) : 0;

// Prepare and execute the SQL query
$sql = "DELETE FROM staff_member WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);

$response = array();

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Member removed successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Member ID not found.';
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
