<?php
/*
 * Controller Class 
 * This class is used for Admin->Student operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getEntityList($data){
		global $conn;
		$result = null;	
		$tableJoin = $data['0']['1'];
		$condition = $data['0']['2'];

		$sql = "SELECT *, CONCAT(stud_lname,', ',stud_fname) AS stud_fullname FROM student
			$tableJoin
			WHERE $condition
			ORDER BY stud_lname ASC, stud_fname ASC			
			LIMIT 25";
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
		$stud_gender = $data['0']['1'];
		$condition = $data['0']['2'];

		$sql = "SELECT COUNT(*) AS entityCount FROM student 
			INNER JOIN studenroll ON stud_no = enrol_stud_no
			WHERE (stud_gender LIKE '$stud_gender'
				$condition)
			ORDER BY stud_lname ASC, stud_fname ASC";
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
	
	
	function getCurrentEnrollment($enrol_stud_no, $enrol_sy){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM studenroll
			WHERE (enrol_stud_no = '$enrol_stud_no'
				AND enrol_sy = '$enrol_sy')
			ORDER BY enrol_sy DESC
			";
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