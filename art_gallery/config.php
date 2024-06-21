<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "sak123";
$dbname = "proj";

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

