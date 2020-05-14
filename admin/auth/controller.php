<?php 
/*
 * Controller Class 
 *
 * This class is used to execute MySQL-related operations for Admin->Auth. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */

class Controller{
	
	function authenticateLogin($data, $user_type){
		global $conn;
		$result = null;		
		$user_name = mysqli_real_escape_string($conn, $data['0']['1']);
		$user_pass = mysqli_real_escape_string($conn, $data['0']['2']);
		$user_pass = MD5($user_pass);
		
		$option = ($user_type == 2 ? " INNER JOIN student ON user_no = stud_no " : " INNER JOIN teacher ON user_no = teach_no ");
		
		$sql = "SELECT * FROM users 
			$option
			WHERE (user_name = '$user_name' 
				AND user_pass = '$user_pass'
				AND user_status = '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "Invalid credential(s).");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;		
	}	
	
	
	function verifyLogin($user_no, $user_type){
		global $conn;
		$result = null;
		
		$option = ($user_type == 2 ? " INNER JOIN student ON user_no = stud_no " : " INNER JOIN teacher ON user_no = teach_no ");
		
		$sql = "SELECT * FROM users 
			$option
			WHERE (user_no = '$user_no' 
				AND user_status = '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;		
	}
	
	
	function changePassword($data){
		global $conn;
		$result = null;		
		$user_name = mysqli_real_escape_string($conn, $data['0']['1']);
		$user_pass = mysqli_real_escape_string($conn, $data['0']['2']);
		$user_pass = MD5($user_pass);
		
		$sql = "UPDATE users 
			SET user_pass = '$user_pass'
			WHERE (user_name = '$user_name')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Password updated.");
		}
		
		return $result;			
	}
	
	
	function saveLog($data){
		global $conn;
		$result = null;	
		$user_no = $data['0'];
		$ip = $data['1'];
		
		$sql = "INSERT INTO users_logs(user_no, ip) 
			VALUES('$user_no', '$ip')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1,"Record added.");
		}
		
		return $result;		
	}

}
?>