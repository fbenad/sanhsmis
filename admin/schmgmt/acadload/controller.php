<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadClassSYs(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT class_sy FROM settings 
			INNER JOIN class ON settings_sy = class_sy
			GROUP BY class_sy
			ORDER BY class_sy DESC";
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
	
	
	function loadClassLoads($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
			
		$sql = "SELECT * FROM class
			INNER JOIN prospectus ON class_pros_no = pros_no
			WHERE (class_sy = '$class_sy' AND pros_part = '1')
			GROUP BY pros_title
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
	
	
	function getTerms($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
		$class_pros_no = $data['0']['2'];
			
		$sql = "SELECT * FROM class
		INNER JOIN prospectus ON class_pros_no = pros_no
			WHERE (class_pros_no = '$class_pros_no'
				AND class_sy = '$class_sy')
			GROUP BY class_sem
			ORDER BY class_sem ASC";
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
	
	
	function loadAssignments($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
		$class_pros_no = $data['0']['2'];
			
		$sql = "SELECT * FROM class
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN teacher ON class_user_name = teach_no
			INNER JOIN section ON class_section_no = section_no
			WHERE (class_pros_no = '$class_pros_no'
				AND class_sy = '$class_sy')
			ORDER BY pros_sort ASC, pros_title ASC";
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
	

	function loadDashboardCounts($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		$options = $data['0']['2'];
		$conditions = $data['0']['3'];
					
		$sql = "SELECT $table
			$options
			$conditions";
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
	
	
	function loadTeachers(){
		global $conn;
		$result = null;	
					
		$sql = "SELECT * FROM teacher
			WHERE (teach_status = '1'
				AND teach_teacher = '1')
			ORDER BY teach_lname ASC, teach_fname ASC";
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
	

	function getTerms2($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
		$class_user_name  = $data['0']['2'];
			
		$sql = "SELECT * FROM class
		INNER JOIN prospectus ON class_pros_no = pros_no
			WHERE (class_user_name  = '$class_user_name '
				AND class_sy = '$class_sy')
			GROUP BY class_sem
			ORDER BY class_sem ASC";
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
	

	function loadAssignments2($data, $class_sem){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
		$class_user_name  = $data['0']['2'];
			
		$sql = "SELECT * FROM class
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN teacher ON class_user_name = teach_no
			INNER JOIN section ON class_section_no = section_no
			WHERE (class_user_name  = '$class_user_name '
				AND class_sy = '$class_sy'
				AND class_sem = '$class_sem')
			ORDER BY pros_sort ASC, pros_title ASC";
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