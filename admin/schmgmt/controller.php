<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getSchoolYears($data){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM settings 
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
	
	
	function getSchoolInfo(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM license";
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
	
	
	function modfySchInfo($data){
		global $conn;
		$result = null;	
		$current_school_code = $data['0']['1'];
		$current_school_name = mysqli_real_escape_string($conn, $data['0']['2']);
		$current_school_full = mysqli_real_escape_string($conn, $data['0']['3']);
		$current_school_short = mysqli_real_escape_string($conn, $data['0']['4']);
		$current_school_address = mysqli_real_escape_string($conn, $data['0']['5']);
		$current_school_district = mysqli_real_escape_string($conn, $data['0']['6']);
		$current_school_division = mysqli_real_escape_string($conn, $data['0']['7']);
		$current_school_region = mysqli_real_escape_string($conn, $data['0']['8']);
		$current_school_reg_code = $data['0']['9'];
		$current_school_contact = mysqli_real_escape_string($conn, $data['0']['10']);
		$current_school_email = mysqli_real_escape_string($conn, $data['0']['11']);
		$current_school_minlevel = $data['0']['12'];
		$current_school_maxlevel = $data['0']['13'];
		
			
		$sql = "UPDATE license
			SET current_school_code = '$current_school_code', 
				current_school_name = '$current_school_name', 
				current_school_full = '$current_school_full', 
				current_school_short = '$current_school_short', 
				current_school_address = '$current_school_address', 
				current_school_district = '$current_school_district', 
				current_school_division = '$current_school_division', 
				current_school_region = '$current_school_region', 
				current_school_reg_code = '$current_school_reg_code', 
				current_school_contact = '$current_school_contact', 
				current_school_email = '$current_school_email', 
				current_school_minlevel = '$current_school_minlevel', 
				current_school_maxlevel = '$current_school_maxlevel'";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;		
	}


	function activateSY($data){
		global $conn;
		$result = null;	
		$settings_sy = $data['0']['1'];
		
		$sql = "UPDATE settings 
			SET activated = '0'";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	

		$sql = "UPDATE settings 
			SET activated = '1'
			WHERE (settings_sy = '$settings_sy')";
		$rs = $conn->query($sql);		
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
	
	
	function checkSY($settings_sy){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM settings
			WHERE (settings_sy = '$settings_sy')";
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
	
	
	function checkCurrYears(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM prospectus
			GROUP BY pros_curr
			ORDER BY pros_curr DESC";
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
	
	
	function getSchoolYear($data){
		global $conn;
		$result = null;	
		$settings_sy = $data['0']['2'];
		
		$sql = "SELECT * FROM settings
			WHERE (settings_sy = '$settings_sy')";
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
	
	
	function addSchoolYear($data){
		global $conn;
		$result = null;	
		$settings_sy = $data['0']['2'];
		$settings_pros = $data['0']['3'];
		$settings_registrar = mysqli_real_escape_string($conn, trim($data['0']['4']));
		$settings_principal = mysqli_real_escape_string($conn, trim($data['0']['5']));
		$settings_supervisor = mysqli_real_escape_string($conn, trim($data['0']['6']));
		$settings_representative = mysqli_real_escape_string($conn, trim($data['0']['7']));
		$settings_superintendent = mysqli_real_escape_string($conn, trim($data['0']['8']));
		$settings_bosy = $data['0']['9'];
		$settings_eosy = $data['0']['10'];
		$settings_late1 = $data['0']['11'];
		$settings_late2 = $data['0']['12'];
		$settings_closing = $data['0']['13'];
		
		$sql = "INSERT INTO settings(settings_sy, settings_sem, settings_pros, settings_month, settings_registrar, settings_principal,
				settings_supervisor, settings_representative, settings_superintendent, settings_bosy,
				settings_eosy, settings_late1, settings_late2, settings_closing, settings_earlyreg, settings_eosynow,
				settings_loginmessage, settings_admissionmessage, activated) 
			VALUES('$settings_sy', '1', '$settings_pros', 'sch_m1', '$settings_registrar', '$settings_principal',  
				'$settings_supervisor', '$settings_representative', '$settings_superintendent', '$settings_bosy', 
				'$settings_eosy', '$settings_late1', '$settings_late2', '$settings_closing', '0', '0',
				'', '', '0')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;				
	}
	
	
	function modifySchoolYear($data){
		global $conn;
		$result = null;	
		$settings_sy = $data['0']['2'];
		$settings_registrar = mysqli_real_escape_string($conn, trim($data['0']['4']));
		$settings_principal = mysqli_real_escape_string($conn, trim($data['0']['5']));
		$settings_supervisor = mysqli_real_escape_string($conn, trim($data['0']['6']));
		$settings_representative = mysqli_real_escape_string($conn, trim($data['0']['7']));
		$settings_superintendent = mysqli_real_escape_string($conn, trim($data['0']['8']));
		$settings_bosy = $data['0']['9'];
		$settings_eosy = $data['0']['10'];
		$settings_late1 = $data['0']['11'];
		$settings_late2 = $data['0']['12'];
		$settings_closing = $data['0']['13'];
		
		$sql = "UPDATE settings 
			SET settings_registrar = '$settings_registrar', 
				settings_principal = '$settings_principal', 
				settings_supervisor = '$settings_supervisor', 
				settings_representative = '$settings_representative', 
				settings_superintendent = '$settings_superintendent', 
				settings_bosy = '$settings_bosy', 
				settings_eosy = '$settings_eosy', 
				settings_late1 = '$settings_late1', 
				settings_late2 = '$settings_late2', 
				settings_closing = '$settings_closing'
			WHERE (settings_sy = '$settings_sy')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
	

	function addSchooldays($data){
		global $conn;
		$result = null;	
		$sch_sy = $data['0']['2'];
		$sch_firstday = $data['0']['3'];
		
		$sql = "INSERT INTO school_days(sch_sy, sch_stud_no, sch_firstday, sch_m1, sch_m2, sch_m3, sch_m4,
				sch_m5, sch_m6, sch_m7, sch_m8, sch_m9, sch_m10, sch_m11, sch_m12) 
			VALUES('$sch_sy', '$sch_sy', '$sch_firstday', '0', '0', '0', '0',
				'0', '0', '0', '0', '0', '0', '0', '0')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;					
	}	
	
	
	function modifyBOSY($data){
		global $conn;
		$result = null;	
		$sch_sy = $data['0']['2'];
		$sch_firstday = $data['0']['3'];
		
		$sql = "UPDATE school_days
			SET sch_firstday = '$sch_firstday'
			WHERE (sch_sy = '$sch_sy' AND sch_stud_no = '$sch_sy')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;					
	}	
	
	
	function getSchoolDays($data){
		global $conn;
		$result = null;	
		$sch_sy = $data['0']['2'];
		
		$sql = "SELECT * FROM school_days
			WHERE (sch_sy = '$sch_sy' AND sch_stud_no = '$sch_sy')";
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


	function modifySchoolDays($data){
		global $conn;
		$result = null;	
		$sch_sy = $data['0']['2'];
		$sch_m1 = $data['0']['3'];
		$sch_m2 = $data['0']['4'];
		$sch_m3 = $data['0']['5'];
		$sch_m4 = $data['0']['6'];
		$sch_m5 = $data['0']['7'];
		$sch_m6 = $data['0']['8'];
		$sch_m7 = $data['0']['9'];
		$sch_m8 = $data['0']['10'];
		$sch_m9 = $data['0']['11'];
		$sch_m10 = $data['0']['12'];
		$sch_m11 = $data['0']['13'];
		$sch_m12 = $data['0']['14'];
		
		$sql = "UPDATE school_days
			SET sch_m1 = '$sch_m1',
				sch_m2 = '$sch_m2',
				sch_m3 = '$sch_m3',
				sch_m4 = '$sch_m4',
				sch_m5 = '$sch_m5',
				sch_m6 = '$sch_m6',
				sch_m7 = '$sch_m7',
				sch_m8 = '$sch_m8',
				sch_m9 = '$sch_m9',
				sch_m10 = '$sch_m10',
				sch_m11 = '$sch_m11',
				sch_m12 = '$sch_m12'
			WHERE (sch_sy = '$sch_sy' AND sch_stud_no = '$sch_sy')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;					
	}			
}