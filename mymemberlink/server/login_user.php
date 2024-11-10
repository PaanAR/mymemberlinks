<?php
// Suppress all error reporting for cleaner output in production
// error_reporting(0);

// Check if 'email' and 'password' are set in the POST request
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $response = array('status' => 'failed', 'data' => null); // Prepare failure response
    sendJsonResponse($response); // Send the response as JSON
    die; // Terminate script execution
}

// Include database connection file to establish connection with the database
include_once("dbconnect.php");

// Retrieve the 'email' and 'password' values from the POST request
$email = $_POST['email'];
$password = sha1($_POST['password']); // Hash the password using SHA-1 for comparison

// SQL query to check if a user with the provided email and hashed password exists in `tbl_admins`
$sqllogin = "SELECT `user_email`, `user_pass` FROM `tbl_users` WHERE `user_email` = '$email' AND `user_pass` = '$password'";
$result = $conn->query($sqllogin); // Execute the query

// Check if the query returned any rows (i.e., the user exists and credentials are correct)
if ($result->num_rows > 0) {
    $response = array('status' => 'success', 'data' => null); // Prepare success response with user data
} else {
    $response = array('status' => 'failed', 'data' => null); // Prepare failure response
}

sendJsonResponse($response); // Send the JSON response

// Function to send a JSON response
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json'); // Set response header to JSON format
    echo json_encode($sentArray); // Convert the array to JSON and output it
}
?>
