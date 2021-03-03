<?php
$servername = "proj-mysql.uopnet.plymouth.ac.uk";

$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

