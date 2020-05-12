<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if(isset($_SESSION['SANHSMIS_Employee']) || isset($_SESSION['SANHSMIS_Student'])){
	session_destroy();
} else {
	session_start();
}

require_once("config/settings.php");

$title = "Dashboard";
include("_header.php");
include("_navbar.php");
include("wall.php");
include("_footer.php");

if(isset($_GET['response'])){
	echo '<script>alert("Error: Cannot connect to database.")</script>;';
	//header("Location: ./");
}
?>