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
			$saveLogData = array($row['user_no'], $_SERVER['REMOTE_ADDR']);
			$saveLog = $controller->saveLog($saveLogData);
			
			if($saveLog['0'] == 1){
				$_SESSION['SANHSMIS_Employee'] = true;
				$_SESSION['SANHSMIS_Locked'] = false;		
				$_SESSION['user_no'] = $row['user_no'];
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_pass'] = $row['user_pass'];
				$_SESSION['user_fullname'] = ucwords(strtolower($row['teach_fname']))." ".$row['teach_lname']." ".ucwords(strtolower($row['teach_xname']));
				$_SESSION['user_gender'] = $row['teach_gender'];
				$message = "Access granted.";
				$status = 1;
				
			} else {
				$message = "Access denied.";
				$status = -1;
			}
			
			$position = $controller->getCurrentPosition($_SESSION['user_no']);
				
			if($position['0'] == 1) {
				$_SESSION['user_position'] = substr($position['2']['field_ext'], 2);
			} else {
				$_SESSION['user_position'] = $position['1'];
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
			$saveLogData = array($row['user_no'], $_SERVER['REMOTE_ADDR']);
			$saveLog = $controller->saveLog($saveLogData);
			
			if($saveLog['0'] == 1){
				$_SESSION['SANHSMIS_Employee'] = true;
				$_SESSION['SANHSMIS_Locked'] = false;		
				$_SESSION['user_no'] = $row['user_no'];
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_pass'] = $row['user_pass'];
				$_SESSION['user_fullname'] = ucwords(strtolower($row['teach_fname']))." ".$row['teach_lname']." ".ucwords(strtolower($row['teach_xname']));
				$_SESSION['user_gender'] = $row['teach_gender'];
				$message = "Access granted.";
				$status = 1;
			} else {
				$message = "Access denied.";
				$status = -1;
			}
			
			$position = $controller->getCurrentPosition($_SESSION['user_no']);
				
			if($position['0'] == 1) {
				$_SESSION['user_position'] = substr($position['2']['field_ext'], 2);
			} else {
				$_SESSION['user_position'] = $position['1'];
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
			$_SESSION['user_pass'] = MD5($data['0']['2']);
		} else {
			$_SESSION['user_pass'] = $_SESSION['user_pass'];
		}
				
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	}
	
} 
?>