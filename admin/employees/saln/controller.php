<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadSYs(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT teachSaln_issueyear FROM teachsaln 
			GROUP BY teachSaln_issueyear
			ORDER BY teachSaln_issueyear DESC";
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
	
	
	function loadEmployees(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM teacher
			INNER JOIN teacherappointments ON teach_no = teacherappointments_teach_no
			WHERE (teacherappointments_status = 'REGULAR-PERMANENT'
				AND teacherappointments_funding = 'NATIONAL'
                AND teach_status = '1'
                AND teacherappointments_active = '1')
			GROUP BY teach_no
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

	
	function getDetails($data, $teachSaln_teach_no){
		global $conn;
		$result = null;	
		$teachSaln_issueyear  = $data['0']['1'];
		
		$sql = "SELECT * FROM teachsaln
			INNER JOIN teacher ON teachSaln_teach_no = teach_no
			WHERE (teachSaln_issueyear = '$teachSaln_issueyear'
				AND teachSaln_teach_no = '$teachSaln_teach_no')";
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
	
	
	function loadTeacherList($data){
		global $conn;
		$result = null;	
		$teachSaln_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teachsaln
			INNER JOIN teacher ON teachSaln_teach_no = teach_no
			WHERE (teachSaln_teach_no = '$teachSaln_teach_no')
			ORDER  BY teachSaln_issueyear DESC";
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
	
	
	function loadCounts($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		$condition = $data['0']['2'];
		
		$sql = "SELECT * FROM $table
			WHERE ($condition)";
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
	
	
	function revertSALNStatus($data){
		global $conn;
		$result = null;	
		$teachSaln_no = $data['0']['1'];
		$user_no = $_SESSION['user_no'];
		
		$sql = "UPDATE teachsaln
			SET teachSaln_status = '2',
				teachSaln_moduser = '$user_no',
				teachSaln_moddatetime = NOW()
			WHERE (teachSaln_no = '$teachSaln_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
}