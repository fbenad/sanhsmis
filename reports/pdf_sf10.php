<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$id = $_GET['id'];
$sy = $_GET['sy'];
$sem = $_GET['sem'];

$result = $conn->query("SELECT * FROM studenroll
	WHERE (enrol_stud_no = '$id')	
	ORDER BY enrol_sy DESC");
$row = $result->fetch_assoc();


if($row['enrol_level'] > 10) {
	header("Location: pdf_sf10shs.php?grade_stud_no=".$id);
} else if($row['enrol_level'] == 10){
	header("Location: pdf_sf10jhs_o.php?grade_stud_no=".$id);
} else if($row['enrol_level'] > 6){
	header("Location: pdf_sf10jhs.php?grade_stud_no=".$id);
} else if($row['enrol_level'] > 0){
	header("Location: pdf_sf10es.php?grade_stud_no=".$id);
}

?>