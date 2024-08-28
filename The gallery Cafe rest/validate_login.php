<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM new_user WHERE user_name = ? AND user_password = ?");
    $stmt->bind_param("ss", $user_name, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$conn->close();
?>
