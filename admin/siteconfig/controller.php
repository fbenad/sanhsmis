<?php
/*
 * Controller Class 
 * This class is used for Admin->Site Configuration operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadGeneralSettings(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM settings 
			WHERE (activated = '1')";
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
	
	
	function getMonthName($current_sy, $month){
		switch($month){
			case 1: $monthName = "June"; break;
			case 2: $monthName = "July"; break;
			case 3: $monthName = "August"; break;
			case 4: $monthName = "September"; break;
			case 5: $monthName = "October"; break;
			case 6: $monthName = "November"; break;
			case 7: $monthName = "December"; break;
			case 8: $monthName = "January"; break;
			case 9: $monthName = "February"; break;
			case 10: $monthName = "March"; break;
			case 11: $monthName = "April"; break;
			case 12: $monthName = "May"; break;
			default: $monthName = "Invalid month.";
		}
		
		return $monthName;
	}
	
	
	function loadDropdownCategory(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM dropdowns 
			GROUP BY field_category
			ORDER bY field_category ASC";
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
	
	
	function loadDropdownFieldNames($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['1'];
			
		$sql = "SELECT * FROM dropdowns 
			WHERE (field_category = '$field_category')
			ORDER bY field_name ASC";
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
	
	
	function modifySettings($data){
		global $conn;
		$result = null;	
		$settings_sy = $data['0']['2'];
		$settings_sem = $data['0']['3'];
		$settings_earlyreg = $data['0']['4'];
		$settings_eosynow = $data['0']['5'];
		$settings_loginmessage = $data['0']['6'];
		$settings_admissionmessage = $data['0']['7'];
		$settings_month = $data['0']['8'];
		
		$sql = "UPDATE settings 
			SET settings_sy = '$settings_sy', 
				settings_sem = '$settings_sem', 
				settings_earlyreg = '$settings_earlyreg', 
				settings_eosynow = '$settings_eosynow', 
				settings_loginmessage = '$settings_loginmessage', 
				settings_admissionmessage = '$settings_admissionmessage',
				settings_month = '$settings_month'
			WHERE (settings_sy = '$settings_sy')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;				
	}
	
	
	function addDropdown($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['2'];
		$field_name = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$field_ext = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));

		
		$sql = "INSERT INTO dropdowns(field_category, field_name, field_ext)
			VALUES('$field_category', '$field_name', '$field_ext')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;				
	}	
}