<?php
session_start();

$servername = "localhost";
$username = "root"; // replace with your DB username
$password = ""; // replace with your DB password
$dbname = "user_registration"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $registration_number = $_POST['registration_number'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND registration_number = ?");
    $stmt->bind_param("ss", $email, $registration_number);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: welcome.php"); // redirect to a welcome page
    } else {
        echo "<script>alert('Login failed: Invalid email or registration number.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
