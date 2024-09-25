<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli('localhost','root','','user_registration');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    // // Check if passwords match
    // if ($password !== $confirm_password) {
    //     echo "<script>alert('Passwords do not match!'); window.location.href='register.html';</script>";
    //     exit();
    // }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate a random 9-digit registration number
    $reg_number = strval(rand(100000000, 999999999));

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password, gender, dob, 	registration_number) 
            VALUES ('$username', '$email', '$hashed_password', '$gender', '$dob', '$reg_number')";

    if ($conn->query($sql) === TRUE) {
        // Display modal with registration number
        echo "<script>
            alert('Registration successful! Your Registration Number is: $reg_number');
            window.location.href='login.html';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
