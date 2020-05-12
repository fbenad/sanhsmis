<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	

	if($_POST['data']['0'] == "reAuthenticate"){
		$data = array_values($_POST);

		$result = $controller->authenticateLogin($data, $_SESSION['user_type']);
		
		if($result['0'] == 1){ $row = $result['2'];
			$saveLogData = array($row['user_no'], $_SERVER['REMOTE_ADDR']);
			$saveLog = $controller->saveLog($saveLogData);
			
			if($_SESSION['user_type'] == 2){
				$user_fullname = ucwords(strtolower($row['stud_fname']))." ".$row['stud_lname']." ".ucwords(strtolower($row['stud_xname']));
				$user_gender = $row['stud_gender'];
				$user_position = "Student | Staff";
			} else {
				$user_fullname = ucwords(strtolower($row['teach_fname']))." ".$row['teach_lname']." ".ucwords(strtolower($row['teach_xname']));
				$user_gender = $row['teach_gender'];
				
				if($row['user_role'] == 1){
					$user_position = "Employee | Administrator";
				} else {
					$user_position = "Employee | Staff";
				}
			}
	
			$_SESSION['SANHSMIS_Employee'] = true;
			$_SESSION['SANHSMIS_Locked'] = false;		
			$_SESSION['user_no'] = $row['user_no'];
			$_SESSION['user_name'] = $row['user_name'];
			$_SESSION['user_pass'] = $row['user_pass'];
			$_SESSION['user_role'] = $row['user_role'];
			$_SESSION['user_fullname'] = $user_fullname;
			$_SESSION['user_position'] = $user_position;
			$_SESSION['user_gender'] = $user_gender;	
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "verifyPassword"){
		$data = array_values($_POST);

		$result = $controller->authenticateLogin($data, $_SESSION['user_type']);
				
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "changePassword"){
		$data = array_values($_POST);

		$result = $controller->changePassword($data);
		
		if($result['0'] == 1){
			$_SESSION['user_pass'] = $data['0']['2'];
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} 
} 
?>