<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "asusi7";
$dbname = "spartan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>