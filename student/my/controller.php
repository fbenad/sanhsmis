<?php
/*
 * Controller Class 
 *
 * This class is used to execute MySQL-related operations for Student->My. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */
 
class Controller{
	
	function getProfile($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
			
		$sql = "SELECT * FROM student 
			WHERE stud_no = '$id'";
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
			WHERE stud_no = '$id'";
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
	

	function getHistory($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM studenroll 
			INNER JOIN student ON enrol_stud_no = stud_no
			WHERE enrol_stud_no = '$id'	
			ORDER BY enrol_sy DESC";
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
	
	
	function getTerms($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (grade_stud_no = '$id') 
			GROUP BY grade_sy, grade_sem
			ORDER BY grade_sy DESC, grade_sem DESC, class_timeslots ASC, pros_sort ASC";
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
	
	
	function getSchedules($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$selectedSY = $data['0']['2'];
		$selectedSem = $data['0']['3'];
		
		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (grade_stud_no = '$id' 
				AND grade_sy = '$selectedSY'
				AND (grade_sem = '$selectedSem' OR grade_sem = '12')) 
			ORDER BY grade_sem ASC, class_timeslots ASC, pros_sort ASC";
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
	
	
	function getSchool($data){
		global $conn;
		$result = null;
		$id = $data['0']['1'];
		$selectedSY = $data['0']['2'];
		
		$sql = "SELECT * FROM studenroll 
			WHERE (enrol_stud_no = '$id'
			 AND enrol_sy = '$selectedSY')";		
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
	
	
	function getGrades($data){
		global $conn;
		$result = null;
		$id = $data['0']['1'];
		$selectedSY = $data['0']['2'];
		$selectedSem = $data['0']['3'];
		
		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (grade_stud_no = '$id' 
				AND grade_sy = '$selectedSY'
				AND grade_sem = '$selectedSem') 
			ORDER BY grade_sem ASC, pros_sort ASC";		
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
		
		$sql = "SELECT * FROM student 
			WHERE ((stud_no = '$username' 
				OR stud_lrn = '$username')
				AND stud_password = '$password')";
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
		
		$sql = "UPDATE student 
			SET stud_password = '$password'
			WHERE stud_no = '$username'";
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
		
		$sql = "SELECT * FROM student 
			WHERE stud_no = '$id'";
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
		
		$sql = "UPDATE student 
			SET stud_username = '$phone'
			WHERE stud_no = '$id'";
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
		
		$sql = "SELECT * FROM student_logs 
			WHERE stud_no = '$id'
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
	
	
	function getEnrollmentDetails($data){
		global $conn;
		$result = null;	
		$stud_no = $data['0']['1'];
		$section_sy = $data['0']['2'];
		
		$sql = "SELECT * FROM studenroll 
			INNER JOIN section ON enrol_section = section_name
			WHERE (enrol_stud_no = '$stud_no'
				AND section_sy = '$section_sy')
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
	
	
	function getProspectus($data, $data2, $condition, $option){
		global $conn;
		$result = null;	
		$stud_no = $data['0']['1'];
		$current_sy = $data['0']['2'];
		$pros_curr  = $data['0']['3'];
		$pros_level = $data2['0']['0']; 
		$pros_track  = $data2['0']['1']; 
		$level_limit = ($pros_level > 10 ? " pros_track = 'SHS GENERAL' OR pros_track = 'SHS APPLIED' OR " : "");
		
		$sql = "SELECT * FROM prospectus
			WHERE (($level_limit
				pros_track = '$pros_track')
				AND pros_curr = '$pros_curr'
				AND pros_part = '1'
				$condition)
			$option
			ORDER BY pros_level ASC, pros_sem ASC, pros_sort ASC";
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
	
	
	function getSubjectCount($stud_no, $pros_no){
		global $conn;
		$result = null;
		
		$sql = "SELECT COUNT(class_pros_no) AS countProsNo FROM grade
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no
			WHERE (grade_stud_no = '$stud_no'
				AND class_pros_no = '$pros_no')";
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
	
	
	function getFinalGrade($stud_no, $pros_no){
		global $conn;
		$result = null;
		
		$sql = "SELECT grade_final FROM grade
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no
			WHERE (grade_stud_no = '$stud_no'
				AND class_pros_no = '$pros_no')
			ORDER BY grade_no DESC";
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