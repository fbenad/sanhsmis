<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$id = $_GET['id'];
$sy = $_GET['sy'];
$b = (isset($_GET['b']) ? 1 : 0);

$result = $conn->query("SELECT * FROM section
	WHERE (section_no = '$id' 
	AND section_sy = '$sy ')");
$row = $result->fetch_assoc();


if($row['section_level'] > 10 && $b == 0) {
	header("Location: pdf_sf5shs.php?enrol_sy=".$sy."&classProfile=".$row['section_name']);
} if($row['section_level'] > 10 && $b == 1) {
	header("Location: pdf_sf5shsb.php?enrol_sy=".$sy."&classProfile=".$row['section_name']);
} else if($row['section_level'] > 0){
	header("Location: pdf_sf5esjhs.php?enrol_sy=".$sy."&classProfile=".$row['section_name']);
} 

?>