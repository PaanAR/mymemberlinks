<?php
// Suppress all error reporting for cleaner output in production
// error_reporting(0);

// Check if email POST variable is set
if (!isset($_POST['email'])) {
    $response = array('status' => 'failed', 'data' => 'Email not provided');
    sendJsonResponse($response);
    die;
}

// Include database connection file to establish connection with the database
include_once("dbconnect.php");

// Retrieve the email from the POST request
$email = $_POST['email'];

// Prepare and execute SQL query to check if the email exists in `tbl_users`
$sqlcheck = "SELECT * FROM `tbl_users` WHERE `user_email` = ?";
$stmt = $conn->prepare($sqlcheck);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned (i.e., if the email exists)
if ($result->num_rows > 0) {
    // Email already exists
    $response = array('status' => 'exists', 'data' => 'Email already registered');
} else {
    // Email does not exist
    $response = array('status' => 'available', 'data' => 'Email is available');
}

sendJsonResponse($response);

// Function to send a JSON response
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
