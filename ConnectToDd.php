<?php

// $host = '127.0.0.1';
$host = 'localhost';
$username = 'root';
$pw = '';
$db = 'test';

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";