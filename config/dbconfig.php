<?php
//local
$servername = "localhost";
$username = "fenad";
$password = "Fernan1%";
$dbname = "sanhsmis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header("Location: ../?response=-1");
	//die("Connection failed: " . $conn->connect_error);
}
?>