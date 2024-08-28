<?php
$servername = "localhost";
$username = "root"; // change as needed
$password = ""; // change as needed
$dbname = "gallery_restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tableId = $_POST['table_id'];
    $customerName = $_POST['customer_name'];
    $mobileNumber = $_POST['mobile_number'];
    $action = $_POST['action'];

    if ($action == 'reserve') {
        // Check if the table is already reserved
        $checkSql = "SELECT status FROM reservation_details WHERE table_id = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $tableId);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($status);
            $stmt->fetch();
            if ($status == 'Reserved') {
                echo json_encode(['success' => false, 'message' => 'Table already reserved.']);
                exit;
            }
        }

        $stmt->close();

        // Reserve the table
        $sql = "INSERT INTO reservation_details (table_id, customer_name, mobile_number, status) VALUES (?, ?, ?, 'Reserved')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $tableId, $customerName, $mobileNumber);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reserve table.']);
        }
        $stmt->close();
    }
}

$conn->close();
?>
