<?php
/*
 * Controller Class 
 *
 * This class is used to execute MySQL-related operations for teh Admin->Employees feature. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */
 
class Controller{
	
	function getEntityList($data){
		global $conn;
		$result = null;	
		$teach_status = $data['0']['1'];
		$condition = $data['0']['2'];

		$sql = "SELECT * FROM teacher 
			WHERE (teach_status LIKE '$teach_status'
				$condition)
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
	
	
	function getEntityCount($data){
		global $conn;
		$result = null;	
		$teach_gender = $data['0']['1'];
		$condition = $data['0']['2'];

		$sql = "SELECT COUNT(*) AS entityCount FROM teacher 
			WHERE (teach_gender LIKE '$teach_gender'
				$condition)
			ORDER BY teach_lname ASC, teach_fname ASC";
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
	
	
	function getPosition($teacherappointments_teach_no){
		global $conn;
		$result = null;	

		$sql = "SELECT field_ext FROM teacherappointments
			INNER JOIN teacher ON teacherappointments_teach_no = teach_no
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