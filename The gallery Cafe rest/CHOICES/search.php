<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];
$query = $conn->real_escape_string($query);

$sql = "SELECT meal_name FROM typesof_meals WHERE meal_type LIKE '%$query%'";
$result = $conn->query($sql);

$meals = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meals[] = $row['meal_name'];
    }
}

$conn->close();

echo json_encode($meals);
?>
