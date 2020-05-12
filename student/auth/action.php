<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "authenticate"){	
		$data = array_values($_POST);
		$status = 1;
		$message = "";
		$authenticateLogin = $controller->authenticateLogin($data);
		
		if($authenticateLogin['0'] == 1){ $row = $authenticateLogin['2']->fetch_assoc();
			$saveLogData = array($row['stud_no'], $_SERVER['REMOTE_ADDR']);
			$saveLog = $controller->saveLog($saveLogData);
			
			if($saveLog['0'] == 1){
				$_SESSION['SANHSMIS_Student'] = true;
				$_SESSION['SANHSMIS_Locked'] = false;		
				$_SESSION['stud_no'] = $row['stud_no'];
				$_SESSION['stud_password'] = $row['stud_password'];
				$_SESSION['stud_fullname'] = ucwords(strtolower($row['stud_fname']))." ".$row['stud_lname']." ".ucwords(strtolower($row['stud_xname']));
				$_SESSION['stud_gender'] = $row['stud_gender'];
				$message = "Access granted.";
				$status = 1;
			} else {
				$message = "Access denied.";
				$status = -1;
			}
			
			$course = $controller->getCourse($_SESSION['stud_no']);
			
			if($course['0'] == 1){
				$_SESSION['enrol_level'] = $course['2']['enrol_level'];
				$_SESSION['enrol_track'] = $course['2']['enrol_track'];
				$_SESSION['enrol_strand'] = $course['2']['enrol_strand'];
				$_SESSION['enrol_combo'] = $course['2']['enrol_combo'];
			} else {
				$_SESSION['enrol_level'] = $course['1'];
				$_SESSION['enrol_track'] = $course['1'];
				$_SESSION['enrol_strand'] = $course['1'];
				$_SESSION['enrol_combo'] = $course['1'];	 		
			}
			
		} else {
			$message = "Invalid credentials.";
			$status = -1;
		}
		
		$result = array($status, $message);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "reAuthenticate"){
		$data = array_values($_POST);
		$status = 1;
		$message = "";
		$authenticateLogin = $controller->authenticateLogin($data);
		
		if($authenticateLogin['0'] == 1){ $row = $authenticateLogin['2']->fetch_assoc();
			$saveLogData = array($row['stud_no'], $_SERVER['REMOTE_ADDR']);
			$saveLog = $controller->saveLog($saveLogData);
			
			if($saveLog['0'] == 1){
				$_SESSION['SANHSMIS_Student'] = true;
				$_SESSION['SANHSMIS_Locked'] = false;		
				$_SESSION['stud_no'] = $row['stud_no'];
				$_SESSION['stud_password'] = $row['stud_password'];
				$_SESSION['stud_fullname'] = ucwords(strtolower($row['stud_fname']))." ".$row['stud_lname']." ".ucwords(strtolower($row['stud_xname']));
				$message = "Access granted.";
				$status = 1;
			} else {
				$message = "Access denied.";
				$status = -1;
			}
			
			$course = $controller->getCourse($_SESSION['stud_no']);
			
			if($course['0'] == 1){
				$_SESSION['enrol_level'] = $course['2']['enrol_level'];
				$_SESSION['enrol_track'] = $course['2']['enrol_track'];
				$_SESSION['enrol_strand'] = $course['2']['enrol_strand'];
				$_SESSION['enrol_combo'] = $course['2']['enrol_combo'];
			} else {
				$_SESSION['enrol_level'] = $course['1'];
				$_SESSION['enrol_track'] = $course['1'];
				$_SESSION['enrol_strand'] = $course['1'];
				$_SESSION['enrol_combo'] = $course['1'];	 		
			}
		} else {
			$message = "Invalid credentials.";
			$status = -1;
		}
		
		$result = array($status, $message);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "changePassword"){
		$data = array_values($_POST);
		$result = $controller->changePassword($data);
		
		if($result['0'] == 1){
			$_SESSION['stud_password'] = MD5($data['0']['2']);
		} else {
			$_SESSION['stud_password'] = $_SESSION['stud_password'];
		}
				
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} 
} 
?>