<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$id = $_GET['id'];
$sy = $_GET['sy'];

$result = $conn->query("SELECT * FROM section
	WHERE (section_no = '$id' 
	AND section_sy = '$sy ')");
$row = $result->fetch_assoc();


if($row['section_level'] > 10) {
	header("Location: pdf_sf1shs.php?enrol_sy=".$sy."&classProfile=".$row['section_name']);
} else if($row['section_level'] > 0){
	header("Location: pdf_sf1esjhs.php?enrol_sy=".$sy."&classProfile=".$row['section_name']);
} 

?>