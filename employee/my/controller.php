<?php
/*
 * Controller Class 
 * This class is used for Student-My operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getProfile($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
			
		$sql = "SELECT * FROM teacher 
			WHERE (teach_no = '$id')";
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
	

	function getContact($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM student 
			INNER JOIN studcontacts 
				ON stud_no = studCont_stud_no
			WHERE (stud_no = '$id')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;		
	}
	
	
	function authenticateLogin($data){
		global $conn;
		$result = null;		
		$action = mysqli_real_escape_string($conn, $data['0']['0']);
		$username = mysqli_real_escape_string($conn, $data['0']['1']);
		$password = mysqli_real_escape_string($conn, $data['0']['2']);
		$password = MD5($password);
		
		$sql = "SELECT * FROM users 
			INNER JOIN teacher ON users.user_no = teach_no
			WHERE (user_no = '$username' 
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
	
	
	function changePassword($data){
		global $conn;
		$result = null;	
		$username = mysqli_real_escape_string($conn, $data['0']['1']);
		$password = mysqli_real_escape_string($conn, $data['0']['3']);
		$password = MD5($password);		
		
		$sql = "UPDATE users 
			SET user_pass = '$password'
			WHERE (user_no = '$username')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1,"Record updated.");
		}	
		
		return $result;	
	}
	
	
	function getPhone($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher 
			WHERE (teach_no = '$id')";
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
	
	
	function savePhone($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$phone = $data['0']['2'];
		
		$sql = "UPDATE teacher 
			SET teach_dialect = '$phone'
			WHERE (teach_no = '$id')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1,"Record updated.");
		}
		
		return $result;			
	}
	
	
	function getLogs($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM users_logs 
			WHERE (user_no = '$id')
			ORDER BY timestamp DESC
			LIMIT 5";
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
	
	
	function getFamily($data){
		global $conn;
		$result = null;	
		$teachCont_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teachercontacts 
			WHERE (teachCont_teach_no = '$teachCont_teach_no')
			ORDER BY teachCont_type ASC, teachCont_bdate ASC";
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
	
	
	function getEducation($data){
		global $conn;
		$result = null;	
		$eback_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher_ebackground 
			WHERE (eback_teach_no = '$eback_teach_no')
			ORDER BY eback_no DESC";
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
	
	
	function getIDs($data){
		global $conn;
		$result = null;	
		$teacherids_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacherids 
			WHERE (teacherids_teach_no = '$teacherids_teach_no')
			ORDER BY teacherids_date_issued DESC";
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
	
	
	function getAppointment($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM  teacherappointments 
			INNER JOIN dropdowns ON teacherappointments_position = field_name
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				AND teacherappointments_item_no != 'ANCILLARY')
			ORDER BY teacherappointments_date DESC";
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
	
	
	function getDesignation($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM  teacherappointments 
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				AND teacherappointments_item_no = 'ANCILLARY')
			ORDER BY teacherappointments_date DESC";
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
	
	
	function getCurrentPosition($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		
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
	
	
	function getBiometricID($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher 
			WHERE (teach_no = '$teach_no')";
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