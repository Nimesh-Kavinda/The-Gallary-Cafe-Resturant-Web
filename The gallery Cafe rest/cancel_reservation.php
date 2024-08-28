<?php
// cancel_reservation.php

header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "gallery_restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Get table_id from POST request
$table_id = $_POST['table_id'];

// Update the reservation status to 'Cancelled'
$sql = "UPDATE reservation_details SET status = 'Cancelled' WHERE table_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $table_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Reservation cancelled successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No reservation found with that Table ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update reservation status: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
