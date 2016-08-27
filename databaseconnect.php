<?php $servername = "localhost";
$username = "githubloginpass";
$password = "xxxxxx";
$database = "githubloginpass";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
