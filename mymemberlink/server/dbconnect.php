<?php
$servername = "localhost:3307"; // or your specific port
$username   = "root";
$password   = "root";
$dbname     = "mymemberlink_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>