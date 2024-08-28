<?php
// login.php
session_start();

// Hardcoded credentials (for demonstration purposes only; in production, use a secure method to handle credentials)
$correctUsername = 'admin';
$correctPassword = 'password';

// Get data from POST request
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Initialize response array
$response = [
    'success' => false,
    'message' => ''
];

// Check credentials
if ($username === $correctUsername && $password === $correctPassword) {
    $_SESSION['loggedin'] = true; // Set session variable
    $response['success'] = true;
    $response['message'] = 'Login successful.';
} else {
    $response['message'] = 'Incorrect username or password.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
