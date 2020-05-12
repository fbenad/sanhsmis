<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getUsers($data){
		global $conn;
		$result = null;	
		$user_status = $data['0']['1'];
		$condition = $data['0']['2'];
			
		$sql = "SELECT * FROM users 
			WHERE (user_status LIKE '$user_status'
				$condition
				AND user_no > 10)
			ORDER BY user_role ASC, user_fullname ASC";
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
	
	
	function getUserCount($data){
		global $conn;
		$result = null;	
		$user_role = $data['0']['1'];
		$condition = $data['0']['2'];
			
		$sql = "SELECT COUNT(*) AS userCount FROM users 
			WHERE (user_role LIKE '$user_role'
				$condition
				AND user_no > 10)
			ORDER BY user_role ASC, user_fullname ASC";
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
	
	
	function updateUserNo($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		
		if($table == "teacher"){
			$field = " teach_no AS u_no, teach_lname AS u_lname, teach_fname AS u_fname, teach_mname AS u_mname, teach_xname AS u_xname ";
			$user_no = " teach_no ";
		} else {
			$field = " stud_no AS u_no, stud_lname AS u_lname, stud_fname AS u_fname, stud_mname AS u_mname, stud_xname AS u_xname ";
			$user_no = " stud_no ";
		}	
		
		$sql = "SELECT $field FROM $table
			WHERE ($user_no NOT IN (SELECT user_no FROM users))
			ORDER BY u_lname ASC, u_fname ASC";
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


	function checkUsername($data){
		global $conn;
		$result = null;	
		$user_name = mysqli_real_escape_string($conn, $data['0']['1']);
			
		$sql = "SELECT * FROM users 
			WHERE (user_name = '$user_name')";
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
	
	
	function addUser($data){
		global $conn;
		$result = null;	
		$user_role = $data['0']['2']; 
		$user_no = $data['0']['3']; 
		$user_name = mysqli_real_escape_string($conn, trim($data['0']['4'])); 
		$user_pass = mysqli_real_escape_string($conn, trim($data['0']['5'])); 
		$user_fullname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['6']))); 
		$user_pass = MD5($user_pass);
			
		$sql = "INSERT INTO users(user_role, user_no, user_name, user_pass, user_fullname, user_status)
			VALUES('$user_role', '$user_no', '$user_name', '$user_pass', '$user_fullname', '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;				
	}
	
	
	function getUser($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2']; 
			
		$sql = "SELECT * FROM users
			WHERE (user_no = '$user_no')";
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
	
	
	function modifyUser($data){
		global $conn;
		$result = null;	
		$user_role = $data['0']['2']; 
		$user_no = $data['0']['3']; 
		$user_name = mysqli_real_escape_string($conn, trim($data['0']['4'])); 
		$user_fullname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5']))); 
			
		$sql = "UPDATE users 
			SET user_role = '$user_role',
				user_name = '$user_name',
				user_fullname = '$user_fullname'
			WHERE (user_no = '$user_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;				
	}
	
	
	function resetUser($data){
		global $conn, $default_pass;
		$result = null;	
		$user_status = $data['0']['1']; 
		$user_no = $data['0']['2']; 
		$user_pass = MD5($default_pass);

		$sql = "UPDATE users 
			SET user_status = '$user_status',
				user_pass = '$user_pass'
			WHERE (user_no = '$user_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		$modifier = $_SESSION['user_no'];
		$sql = "UPDATE teacher 
			SET teach_status = '$user_status',
				teach_lastmod_user_no = '$modifier',
				teach_lastmoddatetime = NOW()
			WHERE (teach_no = '$user_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;				
	}
	
	
	function checkAccess($modacc_user_no, $condition){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM module_access 
			WHERE (modacc_user_no = '$modacc_user_no'
				$condition)";
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
	
	
	function loadModules(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM module
			ORDER BY module_name ASC";
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
		
}