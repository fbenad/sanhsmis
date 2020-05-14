<?php
/*
 * Controller Class 
 * This class is used for Admin-My operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getTotals($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		$option = $data['0']['2'];
		$condition = $data['0']['3'];
		
		$sql = "SELECT COUNT(*) AS getTotals FROM $table 
			$option
			WHERE $condition";
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
	
	
	function getYears(){
		global $conn;
		$result = null;	
		$current_sy = $_SESSION['current_sy'];
		
		$sql = "SELECT settings_sy FROM settings
			WHERE (settings_sy < $current_sy)
			ORDER BY settings_sy DESC 
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
	
	
	function getCount($enrol_sy, $option, $condition){
		global $conn;
		$result = null;	
		
		$sql = "SELECT COUNT(*) aS criteriaCount FROM studenroll
			$option
			WHERE $condition";
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