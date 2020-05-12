<?php 
/*
 * Controller Class
 * This class is used for Student-Logon operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */

class Controller{
	
	function authenticateLogin($data){
		global $conn;
		$result = null;		
		$action = mysqli_real_escape_string($conn, $data['0']['0']);
		$username = mysqli_real_escape_string($conn, $data['0']['1']);
		$password = mysqli_real_escape_string($conn, $data['0']['2']);
		$password = MD5($password);
		
		$sql = "SELECT * FROM users 
			INNER JOIN teacher ON users.user_no = teach_no
			WHERE (user_name = '$username' 
				AND user_pass = '$password')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;		
	}	
	
	
	function saveLog($data){
		global $conn;
		$result = null;	
		$id = $data['0'];
		$ip = $data['1'];
		
		$sql = "INSERT INTO users_logs(user_no, ip) 
			VALUES('$id', '$ip')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1,"Record added.");
		}
		
		return $result;		
	}
	
	
	function changePassword($data){
		global $conn;
		$result = null;		
		$user_no = mysqli_real_escape_string($conn, $data['0']['1']);
		$user_pass = mysqli_real_escape_string($conn, $data['0']['2']);
		$user_pass = MD5($user_pass);
		
		$sql = "UPDATE users 
			SET user_pass = '$user_pass'
			WHERE (user_no = '$user_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getCurrentPosition($teacherappointments_teach_no){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM  teacherappointments 
			INNER JOIN dropdowns ON teacherappointments_position = field_name
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				AND teacherappointments_active = '1')";
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
	
}
?>