<?php $servername = "localhost";
$username = "githubloginpass";
$password = "Testing@16";
$database = "githubloginpass";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
