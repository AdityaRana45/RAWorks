<?php
session_start();

// Database configuration
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "project";

// Create connection
$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input
$username = isset($_POST['uname']) ? trim($_POST['uname']) : '';
$password = isset($_POST['psw']) ? trim($_POST['psw']) : '';

// Query to check admin credentials
$sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['admin_logged_in'] = true;

    // Show popup and redirect using JavaScript
    echo "<script>
        alert('Admin login successful');
        window.location.href = 'readdata.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('Invalid username or password');
        window.location.href = 'login.html';
    </script>";
}

$stmt->close();
$conn->close();
?>
