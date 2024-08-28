<?php
// addstaff.php

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "gallery_restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO staff_member (member_id, member_name, password, position) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $member_id, $member_name, $password, $position);

// Get POST data
$member_id = $_POST['member_id'];
$member_name = $_POST['member_name'];
$password = $_POST['password'];
$position = $_POST['position'];

// Execute the statement
if ($stmt->execute()) {
    echo "New staff member added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
