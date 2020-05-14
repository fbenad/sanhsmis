<?php 
/*
 * Controller Class 
 *
 * This page is used to execute MySQL-related operations for Student->Auth. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */

class Controller{
	
	function authenticateLogin($data){
		global $conn;
		$result = null;		
		$action = mysqli_real_escape_string($conn, $data['0']['0']);
		$username = mysqli_real_escape_string($conn, $data['0']['1']);
		$password = mysqli_real_escape_string($conn, $data['0']['2']);
		$password = MD5($password);
		
		$sql = "SELECT * FROM student 
			WHERE ((stud_no = '$username' 
				OR stud_lrn = '$username')
				AND stud_password = '$password'
				AND stud_status = '1')";
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
		
		$sql = "INSERT INTO student_logs(stud_no, ip) 
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
		$stud_no = mysqli_real_escape_string($conn, $data['0']['1']);
		$stud_password = mysqli_real_escape_string($conn, $data['0']['2']);
		$stud_password = MD5($stud_password);
		
		$sql = "UPDATE student 
			SET stud_password = '$stud_password'
			WHERE (stud_no = '$stud_no ')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getCourse($stud_no){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM studenroll 
			WHERE enrol_stud_no = '$stud_no'	
			ORDER BY enrol_sy DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;			
	}
}
?>