<?php
header('Content-Type: application/json');

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

// SQL query
$sql = "SELECT meal_id, meal_name, meal_type, price, mail_id FROM menu_item";
$result = $conn->query($sql);

$menu_items = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

$conn->close();

// Return the data in JSON format
echo json_encode($menu_items);
?>
