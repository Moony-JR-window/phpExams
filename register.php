<?php
// Show errors (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB config
$host = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'test';

// Create connection
$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    echo "<p style='color:red;'>Please enter both username and password. $username</p>";
}
?>

<!-- HTML form (will submit to same file) -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>User Registration</h2>
    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
