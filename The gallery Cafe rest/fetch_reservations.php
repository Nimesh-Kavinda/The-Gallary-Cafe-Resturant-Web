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

// SQL query to fetch reservations
$sql = "SELECT * FROM reservation_details";
$result = $conn->query($sql);

// Prepare an array to hold the results
$reservations = array();

// Fetch the data and add to the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output the results as JSON
echo json_encode($reservations);
?>
