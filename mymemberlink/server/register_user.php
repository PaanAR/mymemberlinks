<?php
// Suppress all error reporting for cleaner output in production
// error_reporting(0);

// Check if required POST variables are set
if (!isset($_POST['name'], $_POST['email'], $_POST['phoneNum'], $_POST['password'])) {
    $response = array('status' => 'failed', 'data' => null); // Prepare failure response
    sendJsonResponse($response); // Send the response as JSON
    die; // Terminate script execution
}

// Include database connection file to establish connection with the database
include_once("dbconnect.php");

// Retrieve the values from the POST request
$name = $_POST['name'];
$email = $_POST['email'];
$phoneNum = $_POST['phoneNum'];
$password = sha1($_POST['password']); // Hash the password using SHA-1 for security

// SQL query to insert a new admin into `tbl_admins`
$sqlregister = "INSERT INTO `tbl_users` (`user_name`, `user_email`, `user_phoneNum`, `user_pass`) VALUES ('$name', '$email', '$phoneNum', '$password')";
$result = $conn->query($sqlregister); // Execute the query

// Check if the query was successful
if ($result === TRUE) {
    $response = array('status' => 'success', 'data' => null); // Prepare success response
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
