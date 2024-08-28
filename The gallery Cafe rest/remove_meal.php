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

// Retrieve meal_id from POST request
$meal_id = isset($_POST['meal_id']) ? intval($_POST['meal_id']) : 0;

// Prepare and execute the SQL query
$sql = "DELETE FROM menu_item WHERE meal_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $meal_id);

$response = array();

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Meal removed successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Meal ID not found.';
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
