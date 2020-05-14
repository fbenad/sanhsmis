<?php
/*
 * Database Handler
 *
 * This page is used to create a connection to the database. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
 
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