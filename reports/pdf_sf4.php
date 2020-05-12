<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$sy = $_GET['sy'];
$month = $_GET['month'];
$level = $_GET['level'];


if($level == "shs") {
	header("Location: pdf_sf4shs.php?enrol_sy=".$sy."&classProfile=".$month."&g1=11&gn=12");
} else if($level == "jhs" || $level == "es"){
	header("Location: pdf_sf4esjhs.php?enrol_sy=".$sy."&classProfile=".$month."&g1=1&gn=10");
} 

?>