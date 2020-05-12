<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getSYs(){
		global $conn;
		$result = null;	
		$current_sy = $_SESSION['current_sy'];
			
		$sql = "SELECT * FROM settings 
			WHERE (settings_sy < '$current_sy')
			ORDER BY settings_sy DESC";
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

	function getStatusCount($enrol_sy, $condition){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM studenroll 
				INNER JOIN section ON enrol_section = section_name
			WHERE (enrol_sy = '$enrol_sy'
				AND section_sy = '$enrol_sy'
				$condition)";
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

	
	function getCurriculumPerformance($data, $condition, $option){
		global $conn;
		$result = null;
		$section_level = $data['0']['1'];
		$pros_curr = $_SESSION['current_currYear'];
		$class_sy = $_SESSION['current_sy'];
			
		$sql = "SELECT * FROM class 
				INNER JOIN prospectus ON class_pros_no = pros_no
				INNER JOIN section ON class_section_no = section_no
			WHERE (pros_curr = '$pros_curr'
				AND class_sy = '$class_sy'
				AND section_sy = '$class_sy'
				AND section_level = '$section_level'
				$condition)
			$option
			ORDER BY pros_sort ASC";
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

	
	function getProsStatusCount($data, $condition, $option){
		global $conn;
		$result = null;
		$section_level = $data['0']['1'];
		$pros_curr = $_SESSION['current_currYear'];
		$class_sy = $_SESSION['current_sy'];
			
		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN studenroll ON grade_stud_no = enrol_stud_no 
			INNER JOIN section ON class_section_no = section_no 
			WHERE (pros_curr = '2012' 
				AND class_sy = '2019' 
				AND enrol_sy = '2019' 
				AND (enrol_status1 = 'PROMOTED' 
					OR enrol_status1 = 'ENROLLED')
				$condition)
			$option";
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